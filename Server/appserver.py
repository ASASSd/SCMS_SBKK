# Libraries go here
import codecs
import json
import socket
import psycopg2
import threading
from psycopg2 import Error

# Global variables go here
data = ""

# Classes go here
class Management(object):
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
            return -1
        sock.send("GET".encode())   # Sending GET command
        while True:
            data = sock.recv(1024)  # Receiving data
            data = codecs.decode(data, 'utf-8') # Decoding data from binary
            print(data)
            break
        sock.close()
        return 0

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

# Main routine goes here
srvman = Management()
try:
    while True:
        print("Enter command: ")
        command = input()
        if(command == "fetch"):
            print("Result of fetch is: ", srvman.fetch())
        if(command == "poweron"):
            print("Result of poweron is: ", srvman.poweron())
        if(command == "poweroff"):
            print("Result of poweroff is: ", srvman.poweroff())
        if(command == "exit"):
            print("[bye] Exiting now")
            exit(0)
        

except KeyboardInterrupt:
    print("[bye] Exiting unexpectly")
    exit(-1)