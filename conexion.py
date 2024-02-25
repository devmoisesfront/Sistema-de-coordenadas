import pymysql  # Asegúrate de tener instalada la biblioteca necesaria

$servername = "localhost:3306"; // Replace with your MySQL server
$username = "id21878405_admin";         // Replace with your MySQL username
$password = "Energia15+";             // Replace with your MySQL password
$dbname = "id21878405_seguimiento_circuitos"; 

# Intenta establecer la conexión
try:
    conexion = pymysql.connect(host=host, user=usuario, password=contraseña, database=base_de_datos)
    print("Conexión exitosa")

    # Aquí puedes incluir tu código para enviar datos a la base de datos

except Exception as e:
    print(f"Error al conectar a la base de datos: {e}")
finally:
    # Cierra la conexión al finalizar
    if conexion:
        conexion.close()
        print("Conexión cerrada")
