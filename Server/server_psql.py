# Libraries go here
import codecs
import json
import socket
from sqlite3 import Date
import datetime
import time
import psycopg2
import threading
from psycopg2 import Error
from psycopg2.extensions import AsIs, quote_ident

# Database connect goes here
try:
    dbcon = psycopg2.connect(user="postgres", password="", host="localhost",
    port="5432", database="sbk")
    cursor = dbcon.cursor()
    print("PostgreSQL info:\n\r")
    print(dbcon.get_dsn_parameters(), "\n\r")
    cursor.execute("SELECT version();")
    record = cursor.fetchone()
    print("[ok] Connected: ", record, "\n\r")
except(Exception, Error) as error:
    print("[err] PostgreSQL is fucked up:", error)

# Global variables go here
data = ""
parsed_data = (0,)

# Classes go here
class ServerState(object):  # Server telemetry record class
    server_id = int()
    server_status = int()
    smoke = bool()
    temperature = int()
    cpu_load = int()
    date = str()

    def write_db(self):
        cursor.execute("""INSERT INTO server_state (id_server, status, smoke, temperature, cpu_load, date) VALUES (%s, %s, %s, %s, %s, %s);""",(str(self.server_id), str(self.server_status), str(self.smoke), str(self.temperature), str(self.cpu_load), str(self.date)))
        dbcon.commit()
        # repl = cursor.fetchone()
        # print("Database inserted, reply is ", repl)
        return 0

    def fetch_db(self):
        return 0

class Management(object):   # Server management class
    __id = int()

    def set_id(self, id):
        self.__id = id
    def get_id(self):
        return self.__id

    # Data receive routine
    def fetch(self):
        sock = socket.socket()
        try:
            sock.connect(("localhost", 2345))   # Connecting to telemetry server
        except ConnectionRefusedError:
            print("[err] Connection refused")
            return {"error":-1}
        sock.send(json.dumps({0: "GET", 1: self.__id}).encode())   # Sending GET command
        data = sock.recv(1024)  # Receiving data
        data = codecs.decode(data, 'utf-8') # Decoding data from binary
        parsed_data = json.loads(data)
        print(parsed_data)
        sock.close()
        return parsed_data

    # Power on routine
    def poweron(self):
        sock = socket.socket()
        try:
            sock.connect(("localhost", 2345))   # Connecting to telemetry server
        except ConnectionRefusedError:
            print("[err] Connection refused")
            return -1
        sock.send(json.dumps({"0": "PON", "1": self.__id}).encode())   # Sending PON command
        while True:
            data = sock.recv(1024)  # Receiving data
            data = codecs.decode(data, 'utf-8') # Decoding data from binary
            if(data == "OK"):
                print("[ok] Turned on\n\r")
                break
            else:
                print("[err] Unknown reply: ", data)
                break
        sock.close()
        return 0

    # Power off routine
    def poweroff(self):
        sock = socket.socket()
        try:
            sock.connect(("localhost", 2345))   # Connecting to telemetry server
        except ConnectionRefusedError:
            print("[err] Connection refused")
            return -1
        sock.send(json.dumps({0: "POF", 1: self.__id}).encode())   # Sending POF command
        while True:
            data = sock.recv(1024)  # Receiving data
            data = codecs.decode(data, 'utf-8') # Decoding data from binary
            if(data == "OK"):
                print("[ok] Turned off\n\r")
                break
            else:
                print("[err] Unknown reply: ", data)
                break
        sock.close()
        return 0
        
    # Reboot routine
    def reboot(self):
        sock = socket.socket()
        try:
            sock.connect(("localhost", 2345))   # Connecting to telemetry server
        except ConnectionRefusedError:
            print("[err] Connection refused")
            return -1
        sock.send(json.dumps({0: "RST", 1: self.__id}).encode())   # Sending POF command
        while True:
            data = sock.recv(1024)  # Receiving data
            data = codecs.decode(data, 'utf-8') # Decoding data from binary
            if(data == "OK"):
                print("[ok] Rebooting...\n\r")
                break
            else:
                print("[err] Unknown reply: ", data)
                break
        sock.close()
        return 0

# Main routine goes here
srvman = Management()
srvdata = ServerState()
input_data = tuple()
try:
    while True:        
        cursor.execute("SELECT id_server FROM server ORDER BY id_server DESC")
        dbcon.commit()
        repl1 = cursor.fetchone()
        for svid in range(1, 1+repl1[0]):
        
            # Set server id in objects
            srvman.set_id(svid)
            srvdata.server_id = svid
            
            # Fetch data from IPMI server:
            input_data = srvman.fetch()
            try:
                if(input_data["error"] == -1):
                    print("Result of fetch: ", -1)
                    continue
            except KeyError:
                print("All OK!")

            srvdata.server_id = input_data["idServer"]
            srvdata.server_status = input_data["serverStatus"]
            srvdata.smoke = input_data["smokeCheck"]
            srvdata.cpu_load = input_data["CpuLoad"]
            srvdata.temperature = input_data["Temp"]
            srvdata.date = str(datetime.datetime.now().date())
            print("[", svid, "]: ", "Result of fetch is: ", 0)
            
            # Command execution
            cursor.execute("SELECT command FROM server_commands WHERE id_server=%s ORDER BY id_command DESC", str(svid))
            dbcon.commit()
            command_repl = cursor.fetchone()
            try:
                if command_repl[0] == 1:
                    if srvdata.server_status == 0:
                        print("Result of poweron is: ", srvman.poweron())
                    else:
                        print("Result of poweroff is: ", srvman.poweroff())
                elif command_repl[0] == 2:
                    print("Result of reboot is: ", srvman.reboot())
            except TypeError:
                print("[", svid, "]: ", "No commands detected!")
            cursor.execute("DELETE FROM server_commands WHERE id_server=%s", str(svid))
            dbcon.commit()
            
            # Write data to db
            print("[", svid, "]: ", "Result of write_db is: ", srvdata.write_db())
        # time.sleep(1)
            

except KeyboardInterrupt:
    print("[bye] Exiting unexpectly")
    exit(-1)
