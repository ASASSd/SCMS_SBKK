from random import randint
import time
import json
import socket
import codecs
idServerKeys = {}
smokeCheck = False

def gen(id_srv):
    time.sleep(randint(0, 1))
    try:
        if(idServerKeys[id_srv] == 1):
            CpuLoad = randint(40, 80)
            RamLoad = randint(40, 50)
            Temp = randint(50, 70)
            fanSpeed = randint(1000, 1550)
        else:
            CpuLoad = 0
            RamLoad = 0
            Temp = 0
            fanSpeed = 0
        s = json.dumps({'CpuLoad': CpuLoad, 'RamLoad': RamLoad, 'Temp': Temp, 'fanSpeed': fanSpeed, 'idServer': id_srv, 'serverStatus': idServerKeys[id_srv], 'smokeCheck': smokeCheck}, sort_keys=True, indent=4)
        print(s)
        return s
    except KeyError:
        idServerKeys[id_srv] = 0;
        CpuLoad = 0
        RamLoad = 0
        Temp = 0
        fanSpeed = 0
        s = json.dumps({'CpuLoad': CpuLoad, 'RamLoad': RamLoad, 'Temp': Temp, 'fanSpeed': fanSpeed, 'idServer': id_srv, 'serverStatus': idServerKeys[id_srv], 'smokeCheck': smokeCheck}, sort_keys=True, indent=4)
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
        data = json.loads(data)
        if data["0"] == 'POF':
            conn.send('OK'.encode())
            idServerKeys[data["1"]] = 0
        elif data["0"] == 'PON':
            conn.send('OK'.encode())
            idServerKeys[data["1"]] = 1
        elif data["0"] == 'GET':
            conn.send(gen(data["1"]).encode())
        elif data["0"] == 'RST':
            idServerKeys[data["1"]] = randint(0, 1)
            conn.send('OK'.encode())
        else:
            conn.send("ERR".encode())
        conn.close()
    except KeyboardInterrupt:
        exit(-1)
