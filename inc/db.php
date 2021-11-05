<?php
error_reporting(0);
class Database
{

	private $db;
	private static $instance;

	// private constructor
	private function __construct()
	{
		$servername = "localhost";
		$username = "root";
		$password = "";


		try {
			$this->db = new PDO("mysql:host=$servername;dbname=exeat_ms;", $username, $password);
			// set the PDO error mode to exception
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//echo "Connected successfully";
			// I won't echo thsi message but use it to for checking if you connected to the db
			//incase you don't get an error message
		} catch (PDOException $e) {
			echo "Connection failed: " . $e->getMessage();
		}
	}

	//This method must be static, and must return an instance of the object if the object
	//does not already exist.
	public static function getInstance()
	{
		if (!self::$instance instanceof self) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	// The clone and wakeup methods prevents external instantiation of copies of the Singleton class,
	// thus eliminating the possibility of duplicate objects.
	public function __clone()
	{
		trigger_error('Clone is not allowed.', E_USER_ERROR);
	}

	public function __wakeup()
	{
		trigger_error('Deserializing is not allowed.', E_USER_ERROR);
	}

	public function get_name_from_id($tab, $col, $whe, $id)
	{
		try {
			$que = $this->db->prepare("SELECT $tab FROM $col where $whe =?");
			$que->execute([$id]);
			$SingleVar = $que->fetchColumn();
			return $SingleVar;
			$que = null;
		} catch (PDOException $e) {
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function get_name_from_id2($tab, $col, $whe, $id, $whe2, $id2, $ord)
	{
		try {
			$que = $this->db->prepare("SELECT $tab FROM $col WHERE $whe = ? AND $whe2 = ? ORDER BY $ord DESC");
			$que->execute([$id, $id2]);
			$SingleVar = $que->fetchColumn();
			return $SingleVar;
			$que = null;
		} catch (PDOException $e) {
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function get_name_from_id_2($tab, $col, $whe, $id, $whe2, $id2)
	{
		try {
			$que = $this->db->prepare("SELECT $tab FROM $col WHERE $whe = ? AND $whe2 = ?");
			$que->execute([$id, $id2]);
			$SingleVar = $que->fetchColumn();
			return $SingleVar;
			$que = null;
		} catch (PDOException $e) {
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function get_first_day()
	{
		try {
			$first_day = date('Y-m-01');
			$date = strtotime("+2 week", strtotime($first_day));
			$twoWeeks = date('Y-m-d', $date);
			return array("start" => $first_day, "end" => $twoWeeks);
		} catch (PDOException $e) {
			echo 'Error: ' . $e->getMessage();
		}
	}

	// fetch full name by user id
	public function get_fullname_by_id($id)
	{
		try {
			$que = $this->db->prepare("SELECT lastName, middleName, firstName FROM Students WHERE id = ?;");
			$que->execute([$id]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$lname = $row->lastName;
			$mname = $row->middleName;
			$fname = $row->firstName;
			$fullname = ucwords($lname . " " . $mname . " " . $fname);
			return $fullname;
			$que = null;
		} catch (PDOException $e) {
			echo 'Error: ' . $e->getMessage();
		}
	}

	// fetch full name by user id
	public function get_email_by_id($id)
	{
		try {
			$que = $this->db->prepare("SELECT email FROM users WHERE a_user_id = ?;");
			$que->execute([$id]);
			$email = $que->fetch(PDO::FETCH_COLUMN);
			return $email;
			$que = null;
		} catch (PDOException $e) {
			echo 'Error: ' . $e->getMessage();
		}
	}

	//delete
	public function delete_from_where($table, $col, $id)
	{
		try {
			$stmt = $this->db->prepare("DELETE FROM $table WHERE $col = ?");
			$stmt->execute([$id]);
			$stmt = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}


	//delete
	public function delete_things($tab, $col, $value)
	{
		try {
			$stmt = $this->db->prepare("DELETE FROM $tab WHERE $col=?");
			$stmt->execute([$value]);
			$success = 'Done';
			return $success;
			$stmt = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	//delete
	public function delete_things_where2($tab, $col, $value, $col2, $value2)
	{
		try {
			$stmt = $this->db->prepare("DELETE FROM $tab WHERE $col=? AND $col2 = ?");
			$stmt->execute([$value, $value2]);
			$success = 'Done';
			return $success;
			$stmt = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	//alter
	public function alter_things($tab, $col, $where, $value)
	{
		try {
			$empty = "";
			$stmt = $this->db->prepare("UPDATE $tab SET $col = ? WHERE $where = ?")->execute([$empty, $value]);
			$stmt = null;
			$success = 'Done';
			return $success;
			$stmt = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	//alter
	public function alter_things2($tab, $col, $val, $where, $value, $where2, $op, $value2)
	{
		try {
			$stmt = $this->db->prepare("UPDATE $tab SET $col = ? WHERE $where = ? AND $where2 $op ?")->execute([$val, $value, $value2]);
			$stmt = null;
			$success = 'Done';
			return $success;
			$stmt = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	//select order
	public function select_from_where_no($table, $col, $valEmp)
	{
		try {
			$que = $this->db->prepare("SELECT * FROM $table WHERE $col != ?");
			$que->execute([$valEmp]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	//select order
	public function find_loan($col, $user_id)
	{
		try {
			$que = $this->db->prepare("SELECT $col FROM loans WHERE user_id = ? AND  payment_status = 0 OR payment_status = 2 ORDER BY loan_id DESC LIMIT 0,1;");
			$que->execute([$user_id]);
			$arr = $que->fetchColumn();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	//select order
	public function select_my_banks($user_id)
	{
		try {
			$que = $this->db->prepare("SELECT * FROM accounts WHERE user_id = ?");
			$que->execute([$user_id]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}


	public function select_from_where_no3_group($table, $col, $val, $col2, $val2, $col3, $val3, $group, $id, $ord)
	{
		try {
			$que = $this->db->prepare("SELECT * FROM $table WHERE $col = ? AND $col2 = ? AND $col3 = ? GROUP BY $group ORDER BY $id $ord");
			$que->execute([$val, $val2, $val3]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	//sum from table with 4 parameters
	public function sum_where4($col, $table, $col2, $val1, $col3, $val2, $col4, $val3, $col5, $val4)
	{
		$stmt = $this->db->prepare("SELECT SUM($col) AS totalAmt FROM $table WHERE $col2 = ? AND $col3 = ? AND $col4 = ? AND $col5 = ? LIMIT 1");
		$stmt->execute([$val1, $val2, $val3, $val4]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row['totalAmt'];
		$stmt = null;
	}

	//count notifications
	public function count_notifications($user)
	{
		$stmt = $this->db->prepare("SELECT * FROM Notifications WHERE status = 0 AND user_to = ? OR user_to = 'all' ");
		$stmt->execute([$user]);
		$count = $stmt->rowCount();
		return $count;
		$stmt = null;
	}

	//count notifications
	public function count_notifications_admin($user_id)
	{
		$stmt = $this->db->prepare("SELECT * FROM notifications WHERE status = 0 AND user_to = 'admin' OR user_to = ? ");
		$stmt->execute([$user_id]);
		$count = $stmt->rowCount();
		return $count;
		$stmt = null;
	}

	public function select_count($col, $table)
	{
		$stmt = $this->db->prepare("SELECT COUNT($col) FROM $table");
		$stmt->execute([]);
		$count = $stmt->fetch(PDO::FETCH_COLUMN);
		echo $count;
		$stmt = null;
	}

	public function count_all_user_id($table, $where, $user_id)
	{
		$stmt = $this->db->prepare("SELECT COUNT(*) FROM $table WHERE $where = ?");
		$stmt->execute([$user_id]);
		$count = $stmt->fetch(PDO::FETCH_COLUMN);
		echo $count;
		$stmt = null;
	}

	public function count_not_empty($table, $where, $where2)
	{
		$stmt = $this->db->prepare("SELECT COUNT(*) FROM $table WHERE $where <> '' AND $where2 <> ''");
		$stmt->execute([]);
		$count = $stmt->fetch(PDO::FETCH_COLUMN);
		echo $count;
		$stmt = null;
	}

	public function count_is_empty($table, $where, $where2)
	{
		$stmt = $this->db->prepare("SELECT COUNT(*) FROM $table WHERE $where = '' AND $where2 = ''");
		$stmt->execute([]);
		$count = $stmt->fetch(PDO::FETCH_COLUMN);
		echo $count;
		$stmt = null;
	}

	public function count_partial($table, $where, $where2)
	{
		$stmt = $this->db->prepare("SELECT COUNT(*) FROM $table WHERE $where <> '' OR $where2 <> ''");
		$stmt->execute([]);
		$count = $stmt->fetch(PDO::FETCH_COLUMN);
		echo $count;
		$stmt = null;
	}



	public function select_from_where_limit_user($table, $col, $user_id)
	{
		try {
			$que = $this->db->prepare("SELECT * FROM $table WHERE $col = ? LIMIT 20");
			$que->execute([$user_id]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function select_from_where_amt_limit($table, $col, $amt, $col2, $val, $col3, $val2)
	{
		try {
			$que = $this->db->prepare("SELECT * FROM $table WHERE $col = ? AND $col2 = ? AND $col3 = ? LIMIT 20");
			$que->execute([$amt, $val, $val2]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function select_from_where_amt_no3($table, $col, $amt, $col2, $val, $col3, $val2)
	{
		try {
			$que = $this->db->prepare("SELECT * FROM $table WHERE $col = ? AND $col2 = ? AND $col3 = ? LIMIT 20");
			$que->execute([$amt, $val, $val2]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function select_from_where_amt_limit1($table, $col, $amt, $col2, $val)
	{
		try {
			$que = $this->db->prepare("SELECT * FROM $table WHERE $col = ? AND $col2 = ? LIMIT 1");
			$que->execute([$amt, $val]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function show_notification($staff_id, $status)
	{
		try {
			$que = $this->db->prepare("SELECT * FROM notifications WHERE user_to = $staff_id AND status = $status");
			$que->execute();
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function show_notification_all($staff_id)
	{
		try {
			$que = $this->db->prepare("SELECT * FROM notifications WHERE user_to = ? OR user_to = 'all' ORDER BY `status`,date_added ASC LIMIT 0,5");
			$que->execute([$staff_id]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function show_notification_admin($user_id)
	{
		try {
			$que = $this->db->prepare("SELECT * FROM notifications WHERE user_to = 'admin' OR user_to = ? ORDER BY `status`,date_added ASC LIMIT 0,5");
			$que->execute([$user_id]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function select_from_where_amt_limit2($table, $col, $amt, $col2, $val)
	{
		try {
			$que = $this->db->prepare("SELECT * FROM $table WHERE $col = ? AND $col2 = ? LIMIT 20");
			$que->execute([$amt, $val]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}


	public function count_all($table, $user_id)
	{
		$stmt = $this->db->prepare("SELECT COUNT(*) FROM $table WHERE studentID = ?");
		$stmt->execute([$user_id]);
		$count = $stmt->fetch(PDO::FETCH_COLUMN);
		return $count;
		$stmt = null;
	}


	public function count_from($table, $col, $id)
	{
		$stmt = $this->db->prepare("SELECT COUNT(*) FROM $table WHERE $col = ?");
		$stmt->execute([$id]);
		$count = $stmt->fetch(PDO::FETCH_COLUMN);
		return $count;
		$stmt = null;
	}



	public function count_where_not($table, $id)
	{
		$stmt = $this->db->prepare("SELECT COUNT(*) FROM $table WHERE id < ? ORDER BY id DESC");
		$stmt->execute([$id]);
		$count = $stmt->fetch(PDO::FETCH_COLUMN);
		return $count;
		$stmt = null;
	}


	public function count_limit_admin($table)
	{
		$stmt = $this->db->prepare("SELECT COUNT(*) FROM $table");
		$stmt->execute();
		$count = $stmt->fetch(PDO::FETCH_COLUMN);
		return $count;
		$stmt = null;
	}

	//This method is for general select
	public function select($table)
	{
		$stmt = $this->db->prepare("SELECT * FROM $table");
		$stmt->execute();
		$arr = $stmt->fetchAll();
		return $arr;
		$stmt = null;
	} //end class

	//I am using this function with 2 cos I chnaged $id to $user_id
	public function select_from_where2($table, $col, $user_id)
	{
		try {
			$que = $this->db->prepare("SELECT * FROM $table WHERE $col= ?");
			$que->execute([$user_id]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}
	public function select_Applications($hall_id=null,$dept=null,$status=null)
	{
		try {
			if ($status == null && $hall_id != null && $dept == null) {
				$que = $this->db->prepare("SELECT S.hall_id,A.destination AS destination, A.leave_type AS leave_type,A.applicationID AS applicationID, A.depatureDate as depature_date, A.returnDate as return_date, A.reason AS reason, A.status AS status ,A.dateCreated AS dateCreated, A.guardianApproval AS guardianApproval,A.dateReturned,A.dayLeft FROM Students S LEFT JOIN Applications A ON S.id = A.studentID WHERE S.hall_id = ? AND A.status IS NOT NULL;");
				$que->execute([$hall_id]);
				$arr = $que->fetchAll();
			}else if ($status != null && $hall_id == null && $dept != null){
				$que = $this->db->prepare("SELECT S.hall_id,A.destination AS destination, A.leave_type AS leave_type,A.applicationID AS applicationID, A.depatureDate as depature_date, A.returnDate as return_date, A.reason AS reason, A.status AS status ,A.dateCreated AS dateCreated, A.guardianApproval AS guardianApproval,A.dateReturned,A.dayLeft FROM Students S LEFT JOIN Applications A ON S.id = A.studentID WHERE S.department_id = ? AND A.status = ?;");
				$que->execute([$dept,$status]);
				$arr = $que->fetchAll();
			}else if ($status != null && $hall_id == null && $dept == null){
				$que = $this->db->prepare("SELECT S.hall_id,A.destination AS destination, A.leave_type AS leave_type,A.applicationID AS applicationID, A.depatureDate as depature_date, A.returnDate as return_date, A.reason AS reason, A.status AS status ,A.dateCreated AS dateCreated, A.guardianApproval AS guardianApproval,A.dateReturned,A.dayLeft FROM Students S LEFT JOIN Applications A ON S.id = A.studentID WHERE  A.status = ?;");
				$que->execute([$status]);
				$arr = $que->fetchAll();
			}
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function select_Extensions($hall_id)
	{
		try {
			$que = $this->db->prepare("SELECT S.hall_id,E.destination AS destination, E.extensionID as extensionID, E.leave_type AS leave_type,E.applicationID AS applicationID, E.returnDate as return_date, E.reason AS reason, E.status AS status ,E.dateCreated AS dateCreated, E.guardianApproval AS guardianApproval FROM Students S LEFT JOIN Extensions E ON S.id = E.studentID WHERE S.hall_id = ? AND E.status IS NOT NULL;");
			$que->execute([$hall_id]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}




	//I am using this function with 2 cos I chnaged $id to $user_id
	public function select_from_where2_DESC($table, $col, $user_id)
	{
		try {
			$que = $this->db->prepare("SELECT * FROM $table WHERE $col= ? ORDER BY id DESC");
			$que->execute([$user_id]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function select_from_where_no2($tab, $col, $whe, $col2, $whe2)
	{
		try {
			$stmt = $this->db->prepare("SELECT * FROM $tab WHERE $col = ? AND $col2 = ?");
			$stmt->execute([$whe, $whe2]);
			$arr = $stmt->fetchAll();
			return $arr;
			$stmt = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}




	//I am using this function with 2 cos I chnaged $id to $user_id
	public function select_from_where3($table, $col, $user_id)
	{
		try {
			$que = $this->db->prepare("SELECT * FROM $table WHERE $col= ? ORDER BY id DESC");
			$que->execute([$user_id]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}


	//select order
	public function select_order($table, $col, $inv_num)
	{
		try {
			$que = $this->db->prepare("SELECT * FROM $table WHERE $col= ?");
			$que->execute([$inv_num]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	//Selecet order
	public function select_from_ord($table, $id, $ord)
	{
		try {
			$que = $this->db->prepare("SELECT * FROM $table ORDER BY $id $ord");
			$que->execute();
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function select_from_where_ord($tab, $col, $whe, $tab_id, $ord)
	{
		try {

			$stmt = $this->db->prepare("SELECT * FROM $tab WHERE $col = $whe ORDER BY $tab_id $ord");
			$stmt->execute([$whe]);
			$arr = $stmt->fetchAll();
			return $arr;
			$stmt = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function select_from_where_ord2($tab, $col, $whe, $col2, $whe2, $tab_id, $ord)
	{
		try {
			$stmt = $this->db->prepare("SELECT * FROM $tab WHERE $col = ? AND $col2 = ? ORDER BY $tab_id $ord");
			$stmt->execute([$whe, $whe2]);
			$arr = $stmt->fetchAll();
			return $arr;
			$stmt = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function select_from_where3_ord2($tab, $col, $whe, $col2, $whe2, $col3, $whe3, $tab_id, $ord)
	{
		try {
			$stmt = $this->db->prepare("SELECT * FROM $tab WHERE $col = ? AND $col2 = ? AND $col3 = ? ORDER BY $tab_id $ord");
			$stmt->execute([$whe, $whe2, $whe3]);
			$arr = $stmt->fetchAll();
			return $arr;
			$stmt = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function select_from_where_or_ord3($tab, $col, $whe, $col2, $whe2, $tab_id, $ord)
	{
		try {

			$stmt = $this->db->prepare("SELECT * FROM $tab WHERE $col = ? OR $col2 = ? ORDER BY $tab_id $ord");
			$stmt->execute([$whe, $whe2]);
			$arr = $stmt->fetchAll();
			return $arr;
			$stmt = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function select_from_where_ord4($tab, $col, $whe, $col2, $tab_id, $ord)
	{
		try {

			$stmt = $this->db->prepare("SELECT * FROM $tab WHERE $col = $whe AND $col2 = '' ORDER BY $tab_id $ord");
			$stmt->execute([$whe]);
			$arr = $stmt->fetchAll();
			return $arr;
			$stmt = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function select_from_val($table, $col, $val)
	{
		try {
			$que = $this->db->prepare("SELECT * FROM $table WHERE $col= ? LIMIT 1");
			$que->execute([$val]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function select_from_val_ord($table, $col, $val, $id, $ord)
	{
		try {
			$que = $this->db->prepare("SELECT * FROM $table WHERE $col= ? ORDER BY $id $ord LIMIT 1");
			$que->execute([$val]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function select_from_val2_ord($table, $col, $val, $col2, $val2, $id, $ord)
	{
		try {
			$que = $this->db->prepare("SELECT * FROM $table WHERE $col= ? AND $col2 = ? ORDER BY $id $ord LIMIT 0,1");
			$que->execute([$val, $val2]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function select_from_val2_ord_limit_1_1($table, $col, $val, $col2, $val2, $id, $ord)
	{
		try {
			$que = $this->db->prepare("SELECT * FROM $table WHERE $col= ? AND $col2 = ? ORDER BY $id $ord LIMIT 1,1");
			$que->execute([$val, $val2]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function select_from_no_limit($table, $col, $value)
	{
		try {
			$que = $this->db->prepare("SELECT * FROM $table WHERE $col= ?");
			$que->execute([$value]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function select_for_cart($table, $col, $value)
	{
		try {
			$que = $this->db->prepare("SELECT * FROM $table WHERE $col= ?");
			$que->execute([$value]);
			$arr = $que->fetchAll(PDO::FETCH_ASSOC);
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function select_while_user_id($user_id, $col)
	{
		try {
			$que = $this->db->prepare("SELECT * FROM users WHERE $col = ?");
			$que->execute([$user_id]);
			return $que;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function select_from_payment($table, $col, $ref)
	{
		try {
			$que = $this->db->prepare("SELECT * FROM $table WHERE $col= ?");
			$que->execute([$ref]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function select_from_where($table, $col, $id)
	{

		try {
			$que = $this->db->prepare("SELECT * FROM $table WHERE $col= $id LIMIT 1"); //using LIMIt fro optimization purpose
			$que->execute([$id]);
			return $que;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}
	public function select_from_where6($table, $col, $id)
	{

		try {
			$que = $this->db->prepare("SELECT * FROM $table WHERE $col LIKE '%" . $id . "%' LIMIT 1"); //using LIMIt fro optimization purpose
			$que->execute([$id]);
			return $que;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function get_paycode($id)
	{

		try {
			$que = $this->db->prepare("SELECT a_user_id FROM users WHERE payrollID = ?");
			$que->execute([$id]);
			return $que->fetchColumn();
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function select_from_where60($table, $col, $id, $order)
	{

		try {
			$que = $this->db->prepare("SELECT * FROM $table WHERE $col = '" . $id . "' ORDER BY $order DESC"); //using LIMIt fro optimization purpose
			$que->execute([$id]);
			return $que;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function select_from_where61($table, $col, $id, $col2, $id2, $order)
	{

		try {
			$que = $this->db->prepare("SELECT * FROM $table WHERE $col LIKE '" . $id . "' AND $col2 LIKE '" . $col2 . "' ORDER BY $order DESC"); //using LIMIt fro optimization purpose
			$que->execute([$id, $id2]);
			return $que;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function select_from_where8($id)
	{

		try {
			$que = $this->db->prepare("SELECT DISTINCT patient_id , GROUP_CONCAT(order_id) FROM accounts WHERE order_id = " . $id . "");
			$que->execute([$id]);
			return $que;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}
	public function select_from_where7($table, $col, $id)
	{

		try {
			$que = $this->db->prepare("SELECT *, SUM(amount) FROM $table WHERE $col LIKE '%" . $id . "%' LIMIT 1"); //using LIMIt fro optimization purpose
			$que->execute([$id]);
			return $que;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}


	public function select_from_where_no_lim($table, $col, $id)
	{

		try {
			$que = $this->db->prepare("SELECT * FROM $table WHERE $col= ?"); //using LIMIt fro optimization purpose
			$que->execute([$id]);
			return $que;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function select_from_while($table, $col, $val)
	{
		try {
			$que = $this->db->prepare("SELECT * FROM $table WHERE $col= ?");
			$que->execute([$val]);
			return $que;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function select_from_double($table, $col, $val, $col2, $val2)
	{
		try {
			$que = $this->db->prepare("SELECT * FROM $table WHERE $col= ? AND $col2 = ?");
			$que->execute([$val, $val2]);
			return $que;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function select_table($table)
	{
		$stmt = $this->db->prepare("SELECT * FROM $table");
		$stmt->execute();
		return $stmt;
		$stmt = null;
	} //end class


	public function select_from_user($table, $user_id)
	{
		try {
			$que = $this->db->prepare("SELECT * FROM $table WHERE id = ?");
			$que->execute([$user_id]);
			return $que;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	//selecet limit
	public function select_from_where_limit($table, $user_id, $offset, $limit)
	{
		try {
			$que = $this->db->prepare("SELECT * FROM $table WHERE user_id = ? ORDER BY id DESC LIMIT $offset, $limit");
			$que->execute([$user_id]);
			return $que;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function select_from_where_limit_admin($table, $col, $offset, $limit)
	{
		try {
			$que = $this->db->prepare("SELECT * FROM $table ORDER BY $col DESC LIMIT $offset, $limit");
			$que->execute([]);
			return $que;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}


	public function select_from_where_limit_where($val, $offset, $limit)
	{
		try {
			$val2 = 0;
			$que = $this->db->prepare("SELECT * FROM extra_inv_details WHERE client_id= ? AND invoice_sent != ? ORDER BY id DESC LIMIT $offset, $limit");
			$que->execute([$val, $val2]);
			return $que;
			$que = null;
		} catch (PDOException $e) {
			// For handling error			
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function select_from_front_desk_id($pat, $doc)
	{
		try {
			$val2 = 0;
			$que = $this->db->prepare("SELECT * FROM patient_test_group WHERE patient_id = ? AND patient_appointment_id = 0 AND front_desk != '' AND doctor_id = ? ORDER BY patient_test_group_id DESC");
			$que->execute([$pat, $doc]);
			return $que;
			$que = null;
		} catch (PDOException $e) {
			// For handling error			
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function select_from_where_limit_draft($val, $offset, $limit)
	{
		try {
			$val2 = 0;
			$que = $this->db->prepare("SELECT * FROM extra_inv_details WHERE client_id= ? AND invoice_sent = ? ORDER BY id DESC LIMIT $offset, $limit");
			$que->execute([$val, $val2]);
			return $que;
			$que = null;
		} catch (PDOException $e) {
			// For handling error			
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function select_from_where_limit_all($val, $offset, $limit)
	{
		try {
			$que = $this->db->prepare("SELECT * FROM extra_inv_details WHERE client_id= ? ORDER BY id DESC LIMIT $offset, $limit");
			$que->execute([$val]);
			return $que;
			$que = null;
		} catch (PDOException $e) {
			// For handling error			
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function select_from_wherenot_ord($table, $col, $id, $orid, $ord)
	{
		try {
			$que = $this->db->prepare("SELECT * FROM $table where $col!=? ORDER BY $orid $ord");
			$que->execute([$id]);
			$arr = $que->fetchAll();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	//Method to check if user exists before registration
	public function check_email($username)
	{

		try {
			$stmt = $this->db->prepare("SELECT username FROM staff WHERE username= ?");
			$stmt->execute([$username]);
			$row = $stmt->fetch(PDO::FETCH_OBJ);
			return $row;
			$stmt = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	
	public function insert_staff($first,$middle, $last, $email, $role, $hash,$chapel,$hall, $department,$pnumber)
	{
		try {
			if ($role == 'hall_admin') {
				$stmt = $this->db->prepare("INSERT INTO Hall_Admins(firstName,middleName,lastName,email,hall_id,phoneNumber,createdAt) 
				VALUES (?,?,?,?,?,?,NOW())");
				$stmt->execute([$first, $middle, $last, $email,$hall,$pnumber]);
				$stmt = null;
			} else if ($role == 'department') {
				$stmt = $this->db->prepare("INSERT INTO DepartmentStaffs(firstName,middleName,lastName,email,department_id,phoneNumber,createdAt) 
				VALUES (?,?,?,?,?,?,NOW())");
				$stmt->execute([$first, $middle, $last, $email,$department,$pnumber]);
				$stmt = null;
			} else if ($role == 'chapel') {
				$stmt = $this->db->prepare("INSERT INTO ChapelStaffs(firstName,middleName,lastName,email,chapel_id,phoneNumber,createdAt) 
				VALUES (?,?,?,?,?,?,NOW())");
				$stmt->execute([$first, $middle, $last, $email,$chapel,$pnumber]);
				$stmt = null;
			} else {
				$stmt = $this->db->prepare("INSERT INTO SecurityStaffs(firstName,middleName,lastName,email,phoneNumber,createdAt) 
				VALUES (?,?,?,?,?,NOW())");
				$stmt->execute([$first, $middle, $last, $email,$pnumber]);
				$stmt = null;
			}
				
			$stmt = $this->db->prepare("INSERT INTO Users(email,`password`,`role`,createdAt,updatedAt) 
			VALUES (?,?,?,NOW(),NOW())");
			$stmt->execute([$email, $hash, $role]);
			$stmt = null;
			return "Done";
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}


	//For user registration
	public function insert_user($first, $middle, $last, $email, $role, $hash, $chapel, $hall, $department, $matricNumber, $level, $pnumber)
	{
		try {
			if ($role == 'student') {
				$stmt = $this->db->prepare("INSERT INTO Students(firstName,middleName,lastName,email, department_id,`level`,hall_id,chapel_id,matricNumber,phoneNumber,createdAt) 
			VALUES (?,?,?,?,?,?,?,?,?,?,NOW())");
				$stmt->execute([$first, $middle, $last, $email, $department, $level, $hall, $chapel, $matricNumber, $pnumber]);
				// $user_id = $this->db->lastInsertId();
				$stmt = null;

				$stmt = $this->db->prepare("INSERT INTO Users(email,`password`,`role`,createdAt,updatedAt) 
			VALUES (?,?,?,NOW(),NOW())");
				$stmt->execute([$email, $hash, $role]);
				$stmt = null;
			}
			return "Done";
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}
	public function exeat_application($type, $destination, $leaving, $returning, $reason, $user)
	{
		try {
			$stmt = $this->db->prepare("INSERT INTO Applications(`studentID`, `leave_type`, `destination`, `depatureDate`, `returnDate`, `reason`,`status`, `dateCreated`) 
			VALUES (?,?,?,?,?,?,0,NOW())");
			$stmt->execute([$user, $type, $destination, $leaving, $returning, $reason]);

			$stmt = null;

			$msg = "New Application";
			$link = "Applications";
			$stmt = $this->db->prepare("INSERT INTO Notifications(`message`,link,user_to,user_from,`status`,date_added) 
			VALUES (?,?,'hall_admin',?,0,NOW())");
			$stmt->execute([$msg, $link, $user]);

			$stmt = null;
			return "Done";
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function exeat_extension($type,$destination, $to, $reason, $user,$app)
	{
		try {
			$stmt = $this->db->prepare("INSERT INTO Extensions(`studentID`, `leave_type`, `destination`, `returnDate`, `reason`,`applicationID`,`status`, `dateCreated`) 
			VALUES (?,?,?,?,?,?,0,NOW())");
			$stmt->execute([$user, $type, $destination, $to, $reason,$app]);

			$stmt = null;

			$msg = "New Extension";
			$link = "Extensions";
			$stmt = $this->db->prepare("INSERT INTO Notifications(`message`,link,user_to,user_from,`status`,date_added) 
			VALUES (?,?,'hall_admin',?,0,NOW())");
			$stmt->execute([$msg, $link, $user]);

			$stmt = null;
			return "Done";
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	//For user registration
	public function insert_account($b_name, $a_name, $a_number, $user)
	{
		try {
			$stmt = $this->db->prepare("INSERT INTO accounts(bank_name,account_name,account_number,user_id) 
			VALUES (?,?,?,?)");
			$stmt->execute([$b_name, $a_name, $a_number, $user]);

			$stmt = null;
			return "Done";
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function insert_comment($comment,$user,$val)
	{
		try {
			$stmt = $this->db->prepare("INSERT INTO Comments(Comment,ApplicationID,Comment_by) 
			VALUES (?,?,?)");
			$stmt->execute([$comment,$val,$user]);

			$stmt = null;
			return "Done";
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function insert_hall($hall)
	{
		try {
			$stmt = $this->db->prepare("INSERT INTO Halls(hallName) 
			VALUES (?)");
			$stmt->execute([$hall]);

			$stmt = null;
			return "Done";
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function insert_chapel($chapel)
	{
		try {
			$stmt = $this->db->prepare("INSERT INTO Chapels(chapelName) 
			VALUES (?)");
			$stmt->execute([$chapel]);

			$stmt = null;
			return "Done";
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function insert_department($department)
	{
		try {
			$stmt = $this->db->prepare("INSERT INTO Departments(departmentName) 
			VALUES (?)");
			$stmt->execute([$department]);

			$stmt = null;
			return "Done";
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function edit_Department($department,$val)
	{
		try {
			$stmt = $this->db->prepare("UPDATE Departments SET departmentName = ? WHERE id = ?");
			$stmt->execute([$department,$val]);

			$stmt = null;
			return "Done";
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function edit_Hall($name,$val)
	{
		try {
			$stmt = $this->db->prepare("UPDATE Halls SET hallName = ? WHERE id = ?");
			$stmt->execute([$name,$val]);

			$stmt = null;
			return "Done";
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function edit_Chapel($name,$val)
	{
		try {
			$stmt = $this->db->prepare("UPDATE Chapels SET chapelName = ? WHERE id = ?");
			$stmt->execute([$name,$val]);

			$stmt = null;
			return "Done";
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function makePayment($amount, $user, $type)
	{
		try {
			$stmt = $this->db->prepare("INSERT INTO savings(amount,user_id,particular,date_paid,`status`) 
				VALUES (?,?,?,NOW(),0)");
			$stmt->execute([$amount, $user, $type]);
			$saving_id = $this->db->lastInsertId();
			$stmt = null;

			if ($type == 1) {
				$stmt = $this->db->prepare("INSERT INTO passbook(`user_id`, `particular`, `saving_id`, `savings_amount`) 
					VALUES(?,1,?,?)");
				$stmt->execute([$user, $saving_id, $amount]);
				$stmt = null;
			} else if ($type == 2) {
				$loan_amount = $this->find_loan('amount_to_pay', $user);
				$loan_id = $this->find_loan('loan_id', $user);

				$amt = $this->get_name_from_id('amount_paid', 'loans', 'loan_id', $loan_id);
				$new_amt = round($amount + $amt);

				if ($loan_amount != $new_amt) {
					$stmt = $this->db->prepare("UPDATE loans SET amount_paid = ?, payment_status = 2, last_payment_date = NOW() WHERE loan_id = ?;");
					$stmt->execute([$new_amt, $loan_id]);
					$stmt = null;
				} else {
					$stmt = $this->db->prepare("UPDATE loans SET amount_paid = ?, payment_status = 1, last_payment_date = NOW() WHERE loan_id = ?;");
					$stmt->execute([$new_amt, $loan_id]);
					$stmt = null;

					$msg = "You Have Successfully Completed Loan Payment";
					$link = "loans";
					$to = $user;
					$stmt = $this->db->prepare("INSERT INTO notifications(`message`,link,user_to,user_from,`status`,date_added) 
						VALUES (?,?,?,'admin',0,NOW())");
					$stmt->execute([$msg, $link, $to]);
				}

				$stmt = $this->db->prepare("INSERT INTO passbook(`user_id`, `particular`, `saving_id`, `savings_amount`) 
					VALUES(?,2,?,?)");
				$stmt->execute([$user, $saving_id, $amount]);
				$stmt = null;
			}
			return "Done";
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}



	//count column
	public function count_it($tab, $col, $aid)
	{
		try {
			$que = $this->db->prepare("SELECT * FROM $tab WHERE $col = ?");
			$que->execute([$aid]);
			$arr = $que->rowCount();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}


	public function count_for_d($department,$status=10,$col)
	{
		try {
			if ($status == 10) {
				$que = $this->db->prepare("SELECT * FROM `Applications` a LEFT JOIN `Students`s ON a.studentID = s.id WHERE s.$col = ?;");
				$que->execute([$department]);
				$arr = $que->rowCount();
			}else{
				$que = $this->db->prepare("SELECT * FROM `Applications` a LEFT JOIN `Students`s ON a.studentID = s.id WHERE s.$col = ? AND a.status = ?;");
				$que->execute([$department,$status]);
				$arr = $que->rowCount();
			}
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	//count column with where condition
	public function count_it_from($tab, $col, $val1,$col2,$val2)
	{
		try {
			$que = $this->db->prepare("SELECT * FROM $tab WHERE $col = ? AND $col2 = ?");
			$que->execute([$val1,$val2]);
			$arr = $que->rowCount();
			return $arr;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function alterLoanStatus($loan_app_id, $status, $user)
	{
		try {
			$stmt = $this->db->prepare("UPDATE loan_applications SET status = ?, altered_by =?, date_altered = NOW() WHERE loan_id = ?");
			$stmt->execute([$status, $user, $loan_app_id]);
			$stmt = null;

			if ($status == 1) {
				$rate_id = $this->get_name_from_id('rate_id', 'loan_applications', 'loan_id', $loan_app_id);
				$months = $this->get_name_from_id('months', 'rates', 'id', $rate_id);
				$amt = $this->get_name_from_id('amount', 'loan_applications', 'loan_id', $loan_app_id);
				$monthly_pay = round($amt / $months);

				$stmt = $this->db->prepare("INSERT INTO loans(`application_id`,`user_id`,`rate_id`,`amount_to_pay`,`monthly_deductions`,`date_added`) 
				SELECT $loan_app_id, applicant_id, rate_id,amount,$monthly_pay,NOW() FROM loan_applications WHERE loan_id = ?");
				$stmt->execute([$loan_app_id]);
				$stmt = null;

				$loan_id = $this->db->lastInsertId();

				$stmt = $this->db->prepare("INSERT INTO passbook(`user_id`, `particular`, `loan_id`, `loan_application_id`, `loan_amount`) 
				SELECT applicant_id, 3, $loan_id,$loan_app_id,amount FROM loan_applications WHERE loan_id = ?");
				$stmt->execute([$loan_app_id]);
				$stmt = null;

				$msg = "Loan Approved";
				$link = "loans";
				$to = $this->get_name_from_id('user_id', 'loans', 'loan_id', $loan_id);
				$stmt = $this->db->prepare("INSERT INTO notifications(`message`,link,user_to,user_from,`status`,date_added) 
				VALUES (?,?,?,'admin',0,NOW())");
				$stmt->execute([$msg, $link, $to]);
			} else {
				$msg = "Loan Declined";
				$link = "loans";
				$to = $this->get_name_from_id('applicant_id', 'loan_applications', 'loan_id', $loan_app_id);
				$stmt = $this->db->prepare("INSERT INTO notifications(`message`,link,user_to,user_from,`status`,date_added) 
				VALUES (?,?,?,'admin',0,NOW())");
				$stmt->execute([$msg, $link, $to]);
			}

			return "Done";
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function alterStatus($app_id,$status,$user,$table)
	{
		try {
			if ($table == 'Applications') {
				$stmt = $this->db->prepare("UPDATE Applications SET `status` = ?, alteredBy = ?, date_altered = NOW() WHERE applicationID = ?");
			$stmt->execute([$status, $user,$app_id]);
			$stmt = null;
			if ($status == 1) {
				$msg = "Application Approved";
				$link = "viewApplication?id=".$app_id;
				$to = $this->get_name_from_id('studentID', 'Applications', 'ApplicationID', $app_id);
				$stmt = $this->db->prepare("INSERT INTO Notifications(`message`,link,user_to,user_from,`status`,date_added) 
				VALUES (?,?,?,'admin',0,NOW())");
				$stmt->execute([$msg, $link, $to]);
				$stmt = null;
			} else if($status == 2) {
				$msg = "Application Declined";
				$link = "viewApplication?id=".$app_id;
				$to = $this->get_name_from_id('studentID', 'Applications', 'ApplicationID', $app_id);
				$stmt = $this->db->prepare("INSERT INTO Notifications(`message`,link,user_to,user_from,`status`,date_added) 
				VALUES (?,?,?,'admin',0,NOW())");
				$stmt->execute([$msg, $link, $to]);
				$stmt = null;
			}
			} else {
				$stmt = $this->db->prepare("UPDATE Extensions SET `status` = ?, alteredBy = ?, date_altered = NOW() WHERE extensionID = ?");
			$stmt->execute([$status, $user,$app_id]);
			$stmt = null;
			if ($status == 1) {
				$msg = "Extension Approved";
				$link = "viewApplication?id=".$app_id;
				$to = $this->get_name_from_id('studentID', 'Extensions', 'extensionID', $app_id);
				$stmt = $this->db->prepare("INSERT INTO Notifications(`message`,link,user_to,user_from,`status`,date_added) 
				VALUES (?,?,?,'admin',0,NOW())");
				$stmt->execute([$msg, $link, $to]);
				$stmt = null;
			} else if($status == 2) {
				$msg = "Extension Declined";
				$link = "viewApplication?id=".$app_id;
				$to = $this->get_name_from_id('studentID', 'Extensions', 'extensionID', $app_id);
				$stmt = $this->db->prepare("INSERT INTO Notifications(`message`,link,user_to,user_from,`status`,date_added) 
				VALUES (?,?,?,'admin',0,NOW())");
				$stmt->execute([$msg, $link, $to]);
				$stmt = null;
			}
			}
			
			return "Done";
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function leavingStatus($app_id,$status,$user)
	{
		try {
			if ($status == 1) {
				$stmt = $this->db->prepare("UPDATE Applications SET `dayLeft` = NOW(), leavingSecurityID = ? WHERE applicationID = ?");
			} else if($status == 2) {
				$stmt = $this->db->prepare("UPDATE Applications SET `dateReturned` = NOW(), returningSecurityID = ? WHERE applicationID = ?");
			}
			$stmt->execute([$user,$app_id]);
			$stmt = null;
			return "Done";
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function GuardianApproval($app_id,$status,$user,$table)
	{
		try {
			if ($table == 'Applications') {
				if ($status == 1) {
					$stmt = $this->db->prepare("UPDATE Applications SET `guardianApproval` = ?, alteredBy = ?, date_altered = NOW() WHERE applicationID = ?");
					$stmt->execute([$status, $user,$app_id]);
					$stmt = null;
	
					$msg = "Your Guardian Approved Your Application";
					$link = "viewApplication?id=".$app_id;
					$to = $this->get_name_from_id('studentID', 'Applications', 'ApplicationID', $app_id);
					$stmt = $this->db->prepare("INSERT INTO Notifications(`message`,link,user_to,user_from,`status`,date_added) 
					VALUES (?,?,?,'admin',0,NOW())");
					$stmt->execute([$msg, $link, $to]);
					$stmt = null;
				} else if($status == 2) {
					$stmt = $this->db->prepare("UPDATE Applications SET `guardianApproval` = ?,`status` = ?, alteredBy = ?, date_altered = NOW() WHERE applicationID = ?");
					$stmt->execute([$status,$status, $user,$app_id]);
					$stmt = null;
					$msg = "Your Guardian Declined Your Application";
					$link = "viewApplication?id=".$app_id;
					$to = $this->get_name_from_id('studentID', 'Applications', 'ApplicationID', $app_id);
					$stmt = $this->db->prepare("INSERT INTO Notifications(`message`,link,user_to,user_from,`status`,date_added) 
					VALUES (?,?,?,'admin',0,NOW())");
					$stmt->execute([$msg, $link, $to]);
					$stmt = null;
				}
			} else {
				if ($status == 1) {
					$stmt = $this->db->prepare("UPDATE Extensions SET `guardianApproval` = ?, alteredBy = ?, date_altered = NOW() WHERE extensionID = ?");
					$stmt->execute([$status, $user,$app_id]);
					$stmt = null;
	
					$msg = "Your Guardian Approved Your Extension";
					$link = "viewExtension?id=".$app_id;
					$to = $this->get_name_from_id('studentID', 'Extensions', 'extensionID', $app_id);
					$stmt = $this->db->prepare("INSERT INTO Notifications(`message`,link,user_to,user_from,`status`,date_added) 
					VALUES (?,?,?,'admin',0,NOW())");
					$stmt->execute([$msg, $link, $to]);
					$stmt = null;
				} else if($status == 2) {
					$stmt = $this->db->prepare("UPDATE Extensions SET `guardianApproval` = ?,`status` = ?, alteredBy = ?, date_altered = NOW() WHERE extensionID = ?");
					$stmt->execute([$status,$status, $user,$app_id]);
					$stmt = null;
					$msg = "Your Guardian Declined Your Extension";
					$link = "viewExtension?id=".$app_id;
					$to = $this->get_name_from_id('studentID', 'Extensions', 'extensionID', $app_id);
					$stmt = $this->db->prepare("INSERT INTO Notifications(`message`,link,user_to,user_from,`status`,date_added) 
					VALUES (?,?,?,'admin',0,NOW())");
					$stmt->execute([$msg, $link, $to]);
					$stmt = null;
				}
			}
			
			return "Done";
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function addRemark($saving_id, $remark, $user)
	{
		try {
			$stmt = $this->db->prepare("UPDATE savings SET remark = ?, remark_by =?, date_remarked = NOW() WHERE id = ?");
			$stmt->execute([$remark, $user, $saving_id]);
			$stmt = null;
			return "Done";
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function edit_staff($first,$middle, $last, $hash,$val,$table)
	{
		try {
			$stmt = $this->db->prepare("UPDATE $table SET firstName = ?, middleName =?, lastName = ? WHERE id = ?");
			$stmt->execute([$first,$middle, $last,$val]);
			$stmt = null;

			$email = $this->get_name_from_id('email',$table,'id',$val);
			
			if($hash != NULL){
				$stmt = $this->db->prepare("UPDATE Users SET `password` = ? WHERE email = ?");
				$stmt->execute([$hash,$email]);
				$stmt = null;
			}
			return "Done";
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	//user login
	public function check_pass($username, $password)
	{
		if (empty($username)) {
			$sign = 'emptyUsername';
			$loc = '';
			echo json_encode(array("value" => $sign, "value2" => $loc));
		} else if (empty($password)) {
			$sign = 'emptyPass';
			$loc = '';
			echo json_encode(array("value" => $sign, "value2" => $loc));
		} else {
			$stmt = $this->db->prepare("SELECT email FROM Users WHERE email = ? LIMIT 1");
			$stmt->execute([$username]);
			$arr = $stmt->fetchAll();
			if (!$arr) {
				$sign = 'no';
				$loc = '';
				echo json_encode(array("value" => $sign, "value2" => $loc));
			} else {
				$stmt = $this->db->prepare("SELECT `id`, `email`, `password`, `role` FROM Users WHERE `email` = ? LIMIT 1");
				$stmt->execute([$username]);
				$row = $stmt->fetch(PDO::FETCH_OBJ);
				$realusername = $row->email;
				$realpassword = $row->password;
				$user_id = $row->id;
				$role = $row->role;

				if (password_verify($password, $realpassword)) {
					$stmt2 = $this->db->prepare("UPDATE Users SET lastLogin = NOW() WHERE email = ? ")->execute([$username]);
					$stmt2 = null;

					$sign = 'Login';
					$page_id = '';
					$loc = '';
					session_start();
					$_SESSION['userSession'] = $user_id;
					$_SESSION['userRole'] = $role;
					if ($role == 'student') {
						$page = "student/dashboard";
						echo json_encode(array("value" => $sign, "value2" => $loc, "value3" => $user_id, "page" => $page));
					} else if ($role == 'super-admin') {
						$page = "admin/index";
						echo json_encode(array("value" => $sign, "value2" => $loc, "value3" => $user_id, "page" => $page));
					} else if ($role == 'hall_admin') {
						$page = "hall_admin/index";
						echo json_encode(array("value" => $sign, "value2" => $loc, "value3" => $user_id, "page" => $page));
					} else if ($role == 'department') {
						$page = "department/index";
						echo json_encode(array("value" => $sign, "value2" => $loc, "value3" => $user_id, "page" => $page));
					} else if ($role == 'security') {
						$page = "security/index";
						echo json_encode(array("value" => $sign, "value2" => $loc, "value3" => $user_id, "page" => $page));
					} else if ($role == 'chapel') {
						$page = "chapel/index";
						echo json_encode(array("value" => $sign, "value2" => $loc, "value3" => $user_id, "page" => $page));
					} else {
						$result = "<div class='alert alert-danger'>Your Role is incorrect Kindly login accordingly !</div>";
						$sign = 'false';
						echo json_encode(array("value" => $sign, "value2" => $result, "value3" => $user_id));
					}
				} else {
					$result = "<div class='alert alert-danger'>Please enter correct password !</div>";
					$sign = 'false';
					echo json_encode(array("value" => $sign, "value2" => $result, "value3" => $user_id));
				}
			}
			$stmt = null;
		}
	}


	//update db fro when a user logs
	public function logout_user($user_id)
	{
		try {
			$logout = 0;
			$stmt = $this->db->prepare("UPDATE staff SET logged_in = ? WHERE user_id = ?")->execute([$logout, $user_id]);
			$stmt = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	//update db fro when a user logs
	public function notify_viewed($id)
	{
		$stmt = $this->db->prepare("UPDATE notifications SET status = 1 WHERE id = ?")->execute([$id]);
	}

	//update db fro when a user logs output_add_rewrite_var
	public function logout($admin_id)
	{
		try {
			unset($_SESSION['admin_id']);
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}


	public function select_surties($loaner, $surety = 0)
	{
		try {
			if ($surety == 0) {
				$que = $this->db->prepare("SELECT * FROM users WHERE role_id = 2 AND a_user_id != ?
				ORDER BY a_user_id ASC");
				$que->execute([$loaner]);
				return $que;
				$que = null;
			} else {
				$que = $this->db->prepare("SELECT * FROM users WHERE role_id = 2 AND a_user_id != ? AND a_user_id != ?
				ORDER BY a_user_id ASC");
				$que->execute([$loaner, $surety]);
				return $que;
				$que = null;
			}
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function get_report_from($from,$to,$hall_id=null)
	{
		try {
			if ($hall_id == null) {
				$que = $this->db->prepare("SELECT * FROM Applications WHERE depatureDate BETWEEN ? AND  ?
				ORDER BY dateCreated DESC");
				$que->execute([$from,$to]);
				$row = $que->fetchAll();
				return $row;
				$que = null;
			} else {
				$que = $this->db->prepare("SELECT S.hall_id,S.lastName,S.firstName,S.middleName,A.* FROM Applications A RIGHT JOIN Students S ON S.id = A.StudentID WHERE A.applicationID IS NOT NULL AND S.hall_id = ? AND A.depatureDate BETWEEN ? AND ? ORDER BY A.dateCreated DESC");
				$que->execute([$hall_id,$from,$to]);
				$row = $que->fetchAll();
				return $row;
				$que = null;
			}
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function addToSavings($amount, $user)
	{
		try {
			$type = 1;
			$stmt = $this->db->prepare("INSERT INTO savings(amount,user_id,particular,date_paid,`status`) 
				VALUES (?,?,?,NOW(),0)");
			$stmt->execute([$amount, $user, $type]);
			$stmt = null;
			echo 'Done';
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function select_my_savings($user)
	{
		try {
			$que = $this->db->prepare("SELECT SUM(amount) as total FROM savings WHERE user_id = ? AND particular = 1 AND `status` = 1");
			$que->execute([$user]);
			$SingleVar = $que->fetchColumn();
			return $SingleVar;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function select_my_loans($user)
	{
		try {
			$que = $this->db->prepare("SELECT SUM(amount_to_pay - amount_paid) as total FROM loans WHERE `user_id` = ? AND `payment_status` != 1");
			$que->execute([$user]);
			$SingleVar = $que->fetchColumn();
			return $SingleVar;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function select_my_loans_by_paycode($user)
	{
		try {
			$que = $this->db->prepare("SELECT SUM(amount_to_pay - amount_paid) as total FROM loans WHERE `payrollID` = ? AND `payment_status` != 1");
			$que->execute([$user]);
			$SingleVar = $que->fetchColumn();
			return $SingleVar;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function get_limit($user)
	{
		try {
			$res = "";
			$loans = $this->select_my_loans($user);
			if ($loans > 0) {
				$A = $loans;
			} else {
				$A = 0;
			}

			$savings = $this->select_my_savings($user);
			if ($savings > 0) {
				$B = $savings;
			} else {
				$B = 0;
			}
			$limit = $A - $B;
			if ($A >= $B) {
				$res = "Sorry You Cannot Take A Loan Now";
			} else {
				$res = "&#8358;" . (number_format(($B - $A) * 2));
			}
			return $res;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function get_limit2($user)
	{
		try {
			$res = "";
			$loans = $this->select_my_loans($user);
			if ($loans > 0) {
				$A = $loans;
			} else {
				$A = 0;
			}

			$savings = $this->select_my_savings($user);
			if ($savings > 0) {
				$B = $savings;
			} else {
				$B = 0;
			}
			$limit = $A - $B;
			if ($A >= $B) {
				$res = "Sorry You Cannot Take A Loan Now";
			} else {
				$res = ($B - $A) * 2;
			}
			return $res;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function get_withdrawal_limit($user, $amount)
	{
		try {
			$res = "";
			// $loans = $this->select_my_loans($user);
			// if($loans > 0){
			// 	$A = $loans;
			// }else{
			// 	$A = 0;
			// }

			$savings = $this->select_my_savings($user);
			if ($savings > 0) {
				$B = $savings;
			} else {
				$B = 0;
			}
			// $limit = $A-$B;
			// if($A >= $B){
			// 	$res = "Sorry You Cannot Take A Loan Now";
			// }else{
			// 	$res = ($B-$A)*2;
			// }
			$res = ($amount > $B) ? 'Amount Entered (<b>&#8358;' . number_format($amount, 2) . '</b>) Larger Than Savings Amount(<b>&#8358;' . number_format($B, 2) . '</b>)' : $B;
			return $res;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function select_my_repayments($user)
	{
		try {
			$que = $this->db->prepare("SELECT SUM(amount_paid) as total FROM loans WHERE user_id = ? AND payment_status != 1;");
			$que->execute([$user]);
			$SingleVar = $que->fetchColumn();
			return $SingleVar;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function show_passbook()
	{
		try {
			$que = $this->db->prepare("SELECT *  FROM savings GROUP BY user_id DESC");
			$que->execute();
			return $que;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function show_month_savings_passbook($user_id, $year, $month)
	{
		try {
			$que = $this->db->prepare("SELECT YEAR(date_paid) as year, 
			MONTH(date_paid) as saving_date,
			SUM(amount) as saving
			FROM savings 
			WHERE user_id = ?
			AND MONTH(date_paid) = ?
			AND YEAR(date_paid) = ?
			GROUP BY saving_date DESC");
			$que->execute([$user_id, $month, $year]);
			return $que;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function show_month_loans_passbook($user_id, $year, $month)
	{
		try {
			$que = $this->db->prepare("SELECT YEAR(date_altered) as year, 
			MONTH(date_altered) as loan_date,
			SUM(amount) as loan
			FROM loan_applications 
			WHERE applicant_id = ?
			AND MONTH(date_altered) = ?
			AND YEAR(date_altered) = ?
			GROUP BY loan_date DESC");
			$que->execute([$user_id, $month, $year]);
			return $que;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function show_min_year_savings_passbook($user_id)
	{
		try {
			$que = $this->db->prepare("SELECT MIN(YEAR(date_paid)) as year
			FROM savings 
			WHERE user_id = ?");
			$que->execute([$user_id]);
			$SingleVar = $que->fetchColumn();
			return $SingleVar;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function show_min_year_loan_passbook($user_id)
	{
		try {
			$que = $this->db->prepare("SELECT MIN(YEAR(date_altered)) as year
			FROM loan_applications 
			WHERE applicant_id = ?");
			$que->execute([$user_id]);
			$SingleVar = $que->fetchColumn();
			return $SingleVar;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function show_month($month)
	{
		try {
			$que = $this->db->prepare("SELECT MONTHNAME(STR_TO_DATE(?, '%m')) AS 'Month' ");
			$que->execute([$month]);
			$SingleVar = $que->fetchColumn();
			return $SingleVar;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function show_max_year_savings_passbook($user_id)
	{
		try {
			$que = $this->db->prepare("SELECT MAX(YEAR(date_paid)) as year
			FROM savings 
			WHERE user_id = ?");
			$que->execute([$user_id]);
			$SingleVar = $que->fetchColumn();
			return $SingleVar;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function show_max_year_loan_passbook($user_id)
	{
		try {
			$que = $this->db->prepare("SELECT MAX(YEAR(date_altered)) as year
			FROM loan_applications 
			WHERE applicant_id = ?");
			$que->execute([$user_id]);
			$SingleVar = $que->fetchColumn();
			return $SingleVar;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}


	public function get_fields($temp)
	{
		try {
			$que3 = $this->db->prepare("SELECT name FROM lab_temp_name WHERE id = ?");
			$que3->execute([$temp]);
			$row = $que3->fetchAll();
			foreach ($row as $title) :
				$que3 = null;
				$titlee = $title['name'];
				$title = str_replace('_', ' ', $titlee); ?>
<h3><?php ucwords($title); ?></h3>

<?php
				$stmt = $this->db->prepare("SELECT * FROM lab_temps WHERE label_id = ?");
				$stmt->execute([$temp]);
				$row = $stmt->fetchAll();


				foreach ($row as $dets) {
					$name = $dets['temp_name'];
					$name = str_replace('_', ' ', $name);
					$name = ucwords($name);
				?>
<div class="col-md-6">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label><?php echo $name; ?></label>
                <input type="text" class="form-control" name="<?php echo strtolower($name); ?>"
                    placeholder="<?php echo $name; ?>">
            </div>
        </div>
    </div>
</div>

<?php	}
			endforeach;
		} catch (PDOException $e) {
			echo 'Error: ' . $e->getMessage();
		}
	}


	public function change_admi_status($status, $app_id)
	{
		try {
			$stmt = $this->db->prepare("UPDATE admission_request SET status = ? WHERE appointment_id = ?");
			$stmt->execute([$status, $app_id]);
			$stmt = null;

			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Status could not be updated
				  </div>: ' . $e->getMessage();
		}
	}


	public function change_prescription_status($status, $pre_id)
	{
		try {
			$stmt = $this->db->prepare("UPDATE prescription SET prescription_status = ? WHERE prescription_id = ?");
			$stmt->execute([$status, $pre_id]);
			$stmt = null;

			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Status could not be updated
				  </div>: ' . $e->getMessage();
		}
	}





	public function insert_exam_request($val, $doc, $p_id, $ward)
	{
		try {
			$que = $this->db->prepare("SELECT front_desk FROM patients WHERE id = ?");
			$que->execute([$p_id]);
			$row = $que->fetch(PDO::FETCH_OBJ);
			$front2 = $row->front_desk;

			$que = null;
			$stmt = $this->db->prepare("INSERT INTO exam_request(front_desk,appointment_id,doctor_id, patient_id,ward_id) 
		VALUES (?,?,?,?,?)");
			$stmt->execute([$front2, $val, $doc, $p_id, $ward]);
			$stmt = null;
			return "Done";
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function change_exam_status($status, $app_id)
	{
		try {
			$stmt = $this->db->prepare("UPDATE exam_request SET status = ? WHERE appointment_id = ?");
			$stmt->execute([$status, $app_id]);
			$stmt = null;

			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Status could not be updated
				  </div>: ' . $e->getMessage();
		}
	}

	public function change_staff_status($status, $staff_id)
	{
		try {
			$stmt = $this->db->prepare("UPDATE staff SET status = ? WHERE user_id = ?");
			$stmt->execute([$status, $staff_id]);
			$stmt = null;

			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Status could not be updated
				  </div>: ' . $e->getMessage();
		}
	}

	public function get_fields_edit($t_id)
	{
		try {

			$stmt = $this->db->prepare("SELECT * FROM lab_temps WHERE label_id = ?");
			$stmt->execute([$t_id]);
			$row = $stmt->fetchAll();


			foreach ($row as $dets) {
				$name = $dets['temp_name'];
				$tn_id = $dets['id'];
				$name = str_replace('_', ' ', $name);
				$name = ucwords($name);
				?>
<div class="col-md-12">
    <form id="<?php echo $tn_id; ?>">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">

                    <p id="<?php echo $tn_id; ?>"> <?php echo $name; ?></p>
                    <a href="edit_temp_choose?id=<?php echo $tn_id; ?>"
                        style="margin-bottom:10px; background:#1eb902 ! important; border-color:#1eb902  !important;"
                        class="btn btn-primary pull-left btn-flat btblack" id="addre">Edit</a>
                    <a onclick="delf(<?php echo $tn_id; ?>,'<?php echo $name; ?>')" style="margin-bottom:10px;"
                        class="btn btn-primary pull-left btn-flat btblack">Delete</a>
                </div>
            </div>
        </div>

    </form>
</div>
<script type="text/javascript">
var s = jQuery.noConflict();

function delf(ID, name) {
    s.notify({
        icon: 'pe-7s-trash',
        message: "Are you sure you want to delete <b>" + name +
            "</b> from templates ? </br><button type='button' class='btn pop-btn' onclick='delet(" + ID +
            ")'>Delete</button>"
    }, {
        type: 'danger',
        timer: 100000
    });
}

function delet(ID) {
    var val = ID;
    document.getElementById("load").style.display = "block";
    s.ajax({
        type: 'post',
        url: '../func/del.php',
        data: "val=" + val + '&ins=delTempp',
        success: function(data) {
            document.getElementById("load").style.display = "block";
            if (data === 'Done') {
                console.log(data);
                location.reload();
            } else {
                jQuery('#get_det' + ID).html(data).show();
            }
        }
    });
}
</script>
<?php	}
		} catch (PDOException $e) {
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function edit_tempy($name, $val)
	{
		try {
			$stmt = $this->db->prepare("UPDATE lab_temps SET temp_name = ? WHERE id = ?");
			$stmt->execute([$name, $val]);
			$stmt = null;

			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Status could not be updated
				  </div>: ' . $e->getMessage();
		}
	}

	public function add_fields($val, $DataArr)
	{
		$data_count = count($DataArr);
		for ($i = 0; $i < $data_count; $i++) {
			$fieldsst = htmlspecialchars(ucfirst($_POST['fieldsst'][$i]));
			$fieldsst = stripslashes(ucfirst($_POST['fieldsst'][$i]));
			$fieldsst = trim(ucfirst($_POST['fieldsst'][$i]));

			$stmt = $this->db->prepare("INSERT INTO lab_temps(temp_name, label_id) 
			VALUES (?,?)");

			$stmt->execute(array($fieldsst, $val));
			return "Done";
			$stmt = null;
		}
	}

	public function edit_tempa($temp_name, $val)
	{
		try {
			$stmt = $this->db->prepare("UPDATE lab_temp_name SET name = ? WHERE id = ?");
			$stmt->execute([$temp_name, $val]);
			$stmt = null;

			$success = 'Done';
			return $success;
		} catch (PDOException $e) {
			// For handling error
			echo '<div class="alert alert-danger">
					 Status could not be updated
				  </div>: ' . $e->getMessage();
		}
	}
}