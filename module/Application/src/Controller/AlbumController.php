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

	public function indexAction() {

		$r = $this->db->query('SELECT * FROM albums');
		$r = $r->execute();
		foreach ($r as $item) {
			echo '<pre>' . print_r($item, true) . '</pre>';
		}
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