from random import randint
import time
import json
import socket
import codecs
idServer = 1
serverStatus = randint(0,1)
smokeCheck = 0

def gen():
    time.sleep(randint(0,1))
    if(serverStatus == 1):
        CpuLoad = randint(70, 80)
        RamLoad = randint(40, 50)
        Temp = randint(50, 60)
        fanSpeed = randint(1000, 1200)
    else:
        CpuLoad = 0
        RamLoad = 0
        Temp = 0
        fanSpeed = 0
    s = json.dumps({'CpuLoad': CpuLoad, 'RamLoad': RamLoad, 'Temp': Temp, 'fanSpeed': fanSpeed, 'idServer': idServer, 'serverStatus': serverStatus, 'smokeCheck': smokeCheck}, sort_keys=True, indent=4)
    print(s)
    return s

serverSocket = socket.socket()
serverSocket.bind(('', 2345))
serverSocket.listen(5)
#conn, addr = serverSocket.accept()
#print('connected:', addr)

while True:
    try:
        conn, addr = serverSocket.accept()
        print('connected:', addr)
        data = conn.recv(1024)
        data = codecs.decode(data, 'utf-8')
        if data == 'POF':
            conn.send('OK'.encode())
            serverStatus = 0
        elif data == 'PON':
            conn.send('OK'.encode())
            serverStatus = 1
        elif data == 'GET':
            conn.send(gen().encode())
        else:
            conn.send("ERR".encode())
        conn.close()
    except KeyboardInterrupt:
        exit(-1)