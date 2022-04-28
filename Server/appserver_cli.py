# Libraries go here
import codecs
import json
import socket
from sqlite3 import Date
from datetime import datetime
import time
import psycopg2
import threading
from psycopg2 import Error

# Database connect goes here
try:
    dbcon = psycopg2.connect(user="administrator", password="cisco", host="localhost",
    port="5432", database="sbkk")
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
class Server(object):   # Server class
    id = int()
    name = str()
    model = str()
    desc = str()
    __invnum = int()

    def get_invnum(self):
        return self.__invnum
    def set_invnum(self, invnum):
        self.__invnum = invnum

class ServerState(object):  # Server telemetry record class
    server_id = int()
    server_status = int()
    smoke = bool()
    temperature = int()
    cpu_load = int()
    date = float()

    def write_db(self):
        insertquery = "INSERT INTO server_state (id_server, status, smoke, temperature, cpu_load, date) VALUES (" + str(self.server_id) + ", " + str(self.server_status) + ", " + str(self.smoke) + ", " + str(self.temperature) + ", " + str(self.cpu_load) +  ", " + str(self.date) + ");"
        cursor.execute(insertquery)
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
        sock.send("GET".encode())   # Sending GET command
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
        sock.send("PON".encode())   # Sending PON command
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
        sock.send("POF".encode())   # Sending POF command
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

# Main routine goes here
srvman = Management()
srv = Server()
srvdata = ServerState()
input_data = tuple()
try:
    while True:
        print("Enter command: ")
        command = input()

        if(command == "fetch"):
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
            srvdata.date = time.time()
            print("Result of fetch is: ", 0)

        elif(command == "poweron"):
            print("Result of poweron is: ", srvman.poweron())
        elif(command == "poweroff"):
            print("Result of poweroff is: ", srvman.poweroff())
        elif(command == "exit"):
            print("[bye] Exiting now")
            exit(0)
        elif(command == "fetch_db"):
            print("Result of fetch_db is: ", srvdata.fetch_db())
        elif(command == "write_db"):
            print("Result of write_db is: ", srvdata.write_db())
        

except KeyboardInterrupt:
    print("[bye] Exiting unexpectly")
    exit(-1)