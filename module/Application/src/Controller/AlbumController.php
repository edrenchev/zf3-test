<?php
/**
 * Created by PhpStorm.
 * User: ervin
 * Date: 2017-06-02
 * Time: 09:12
 */

namespace Application\Controller;


use Application\Model\Album;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Hydrator\Reflection as ReflectionHydrator;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Sql;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\Adapter\Driver\ResultInterface;


class AlbumController extends AbstractActionController {
	// Add this property:
	private $db;

	// Add this constructor:
	public function __construct(\Zend\Db\Adapter\Adapter $db) {
		$this->db = $db;
	}

	public function getAll($sql) {
		$r = $this->db->query($sql);
		$r = $r->execute();

		$res = [];
		foreach ($r as $item) {
			$res[] = $item;
		}
		return $res;
	}

	public function getOne($sql) {
		$r = $this->db->query($sql);
		$r = $r->execute();

		$res = [];
		foreach ($r as $item) {
			$res = reset($item);
			break;
		}
		return $res;
	}

	public function getCol($sql) {
		$r = $this->db->query($sql);
		$r = $r->execute();

		$res = [];
		foreach ($r as $item) {
			$res[] = reset($item);
		}
		return $res;
	}

	public function getRow($sql) {
		$r = $this->db->query($sql);
		$r = $r->execute();

		$res = [];
		foreach ($r as $item) {
			$res = $item;
			break;
		}
		return $res;
	}

	public function getAssoc($sql) {
		$r = $this->db->query($sql);
		$r = $r->execute();

		$res = [];

		if($r->getFieldCount() < 3) {
			foreach ($r as $item) {
				$item = array_values($item);
				$res[$item[0]] = $item[1];
			}
		} else {
			foreach ($r as $item) {
				$res[reset($item)] = $item;
			}
		}
		return $res;
	}



	public function indexAction() {

//		$res = $this->getAll('SELECT * FROM albums');
//		$res = $this->getOne('SELECT title FROM albums');
//		$res = $this->getCol('SELECT title FROM albums');
//		$res = $this->getAssoc('SELECT artist, albums.* FROM albums');
//		$res = $this->getAssoc('SELECT artist, title FROM albums');


		$r = $this->db->query('INSERT INTO albums (artist, title) VALUE(?)', ['artis"t1','ti<--tle1']);

		echo '<pre>' . print_r($r, true) . '</pre>';
		die();

		$result = $this->db->getDriver()->getConnection()->execute('SELECT * FROM albums');
		echo '<pre>' . print_r($result, true) . '</pre>';
		die();
		if (!$result instanceof ResultInterface || !$result->isQueryResult()) {
			return [];
		}

		$resultSet = new HydratingResultSet(
			new ReflectionHydrator(),
			new Album('', '')
		);
		$resultSet->initialize($result);

		foreach ($resultSet as $item) {
			echo '<pre>' . print_r($item, true) . '</pre>';

		}
		die();

//		echo '<pre>' . print_r($this->table->fetchAll(), true) . '</pre>';
//		die();

		$sql = new Sql($this->db);
		$select = $sql->select('albums')->where(['id'=>1]);
		$stmt = $sql->prepareStatementForSqlObject($select);
		$result = $stmt->execute();


//		echo '<pre>' . print_r($resultSet, true) . '</pre>';
//		die();

		return new ViewModel([
			'albums' => $resultSet,
		]);
	}

	public function addAction() {
	}

	public function editAction() {
	}

	public function deleteAction() {
	}
}