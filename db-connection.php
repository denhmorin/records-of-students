<?php
$username = "root";
$password = "";
$dbname = "records_of_students";
$servername = "localhost";

$conn = new mysqli($servername,$username,$password,$dbname);
mysqli_set_charset($conn,"utf8");

if(mysqli_connect_errno()){
	echo 'Došlo je do pogreške kod spajanja na bazu.';
	echo mysqli_connect_error();
	exit();
}else{
	echo "<script>console.log( 'Uspješno spojeno na bazu.' );</script>";
}

function doQuery($conn,$sql){
	$result = $conn->query($sql);
	return $result;
}

if ( !class_exists( 'DB' ) ) {
	class DB {
		public function __construct($user, $password, $database, $host = 'localhost') {
			$this->user = $user;
			$this->password = $password;
			$this->database = $database;
			$this->host = $host;
		}
		protected function connect() {
			$db = new mysqli($this->host, $this->user, $this->password, $this->database);
			mysqli_set_charset($db,"utf8");
			return $db;
		}
		public function query($query) {
			$db = $this->connect();
			$result = $db->query($query);
			
			while ( $row = $result->fetch_object() ) {
				$results[] = $row;
			}
			
			return $results;
		}
		public function insert($table, $data, $format) {
			// Check for $table or $data not set
			if ( empty( $table ) || empty( $data ) ) {
				return false;
			}
			
			// Connect to the database
			$db = $this->connect();
			
			// Cast $data and $format to arrays
			$data = (array) $data;
			$format = (array) $format;
			
			// Build format string
			$format = implode('', $format); 
			$format = str_replace('%', '', $format);
			
			list( $fields, $placeholders, $values ) = $this->prep_query($data);
			
			// Prepend $format onto $values
			array_unshift($values, $format); 
			// Prepary our query for binding
			$stmt = $db->prepare("INSERT INTO {$table} ({$fields}) VALUES ({$placeholders})");
			// Dynamically bind values
			_func_array( array( $stmt, 'bind_param'), $this->ref_values($values));
			
			// Execute the query
			$stmt->execute();
			
			// Check for successful insertion
			if ( $stmt->affected_rows ) {
				return true;
			}
			
			return false;
		}
		public function update($table, $data, $format, $where, $where_format) {
			// Check for $table or $data not set
			if ( empty( $table ) || empty( $data ) ) {
				return false;
			}
			
			// Connect to the database
			$db = $this->connect();
			
			// Cast $data and $format to arrays
			$data = (array) $data;
			$format = (array) $format;
			
			// Build format array
			$format = implode('', $format); 
			$format = str_replace('%', '', $format);
			$where_format = implode('', $where_format); 
			$where_format = str_replace('%', '', $where_format);
			$format .= $where_format;
			
			list( $fields, $placeholders, $values ) = $this->prep_query($data, 'update');
			
			//Format where clause
			$where_clause = '';
			$where_values = '';
			$count = 0;
			
			foreach ( $where as $field => $value ) {
				if ( $count > 0 ) {
					$where_clause .= ' AND ';
				}
				
				$where_clause .= $field . '=?';
				$where_values[] = $value;
				
				$count++;
			}
			// Prepend $format onto $values
			array_unshift($values, $format);
			$values = array_merge($values, $where_values);
			// Prepary our query for binding
			$stmt = $db->prepare("UPDATE {$table} SET {$placeholders} WHERE {$where_clause}");
			
			// Dynamically bind values
			call_user_func_array( array( $stmt, 'bind_param'), $this->ref_values($values));
			
			// Execute the query
			$stmt->execute();
			
			// Check for successful insertion
			if ( $stmt->affected_rows ) {
				return true;
			}
			
			return false;
		}
		public function select($query, $data, $format) {
			// Connect to the database
			$db = $this->connect();

			//Prepare our query for binding
			$stmt = $db->prepare($query);
			
			//Normalize format
			$format = implode('', $format); 
			$format = str_replace('%', '', $format);
			
			// Prepend $format onto $values
			array_unshift($data, $format);
			
			//Dynamically bind values
			call_user_func_array( array( $stmt, 'bind_param'), $this->ref_values($data));
			
			//Execute the query
			$stmt->execute();
			
			//Fetch results
			$result = $stmt->get_result();
			
			//Create results object
			while ($row = $result->fetch_object()) {
				$results[] = $row;
			}
			return $results;
		}
		public function delete($table, $id) {
			// Connect to the database
			$db = $this->connect();
			
			// Prepary our query for binding
			$stmt = $db->prepare("DELETE FROM {$table} WHERE ID = ?");
			
			// Dynamically bind values
			$stmt->bind_param('d', $id);
			
			// Execute the query
			$stmt->execute();
			
			// Check for successful insertion
			if ( $stmt->affected_rows ) {
				return true;
			}
		}
		private function prep_query($data, $type='insert') {
			// Instantiate $fields and $placeholders for looping
			$fields = '';
			$placeholders = '';
			$values = array();
			
			// Loop through $data and build $fields, $placeholders, and $values			
			foreach ( $data as $field => $value ) {
				$fields .= "{$field},";
				$values[] = $value;
				
				if ( $type == 'update') {
					$placeholders .= $field . '=?,';
				} else {
					$placeholders .= '?,';
				}
				
			}
			
			// Normalize $fields and $placeholders for inserting
			$fields = substr($fields, 0, -1);
			$placeholders = substr($placeholders, 0, -1);
			
			return array( $fields, $placeholders, $values );
		}
		private function ref_values($array) {
			$refs = array();
			foreach ($array as $key => $value) {
				$refs[$key] = &$array[$key]; 
			}
			return $refs; 
		}
		public function test_input($data) {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
        }
	}
}

?>