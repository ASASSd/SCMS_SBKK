<?PHP
	$socket = stream_socket_server("tcp://127.0.0.1:8000",$errno,$errstr);
	if (!$socket) {
	    die("$errstr ($errno)\n");
	}

	while ($connect = stream_socket_accept($socket, -1)) {
	    fwrite($connect, "HTTP/1.1 200 OK\r\nContent-Type: text/html\r\nConnection: close\r\n\r\nПривет");
	    fclose($connect);
	}
?>