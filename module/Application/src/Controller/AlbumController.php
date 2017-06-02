<?php
/**
 * Created by PhpStorm.
 * User: ervin
 * Date: 2017-06-02
 * Time: 09:12
 */

namespace Application\Controller;


use Application\Model\AlbumTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AlbumController extends AbstractActionController {
	// Add this property:
	private $table;

	// Add this constructor:
	public function __construct(AlbumTable $table) {
		$this->table = $table;
	}

	public function indexAction() {
//		echo '<pre>' . print_r($this->table->fetchAll(), true) . '</pre>';
//		die();
		return new ViewModel([
			'albums' => $this->table->fetchAll(),
		]);
	}

	public function addAction() {
	}

	public function editAction() {
	}

	public function deleteAction() {
	}
}