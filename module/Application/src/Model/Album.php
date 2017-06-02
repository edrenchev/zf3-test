<?php
/**
 * Created by PhpStorm.
 * User: ervin
 * Date: 2017-06-02
 * Time: 09:21
 */

namespace Application\Model;


class Album {
	public $id;
	public $artist;
	public $title;

	public function exchangeArray(array $data) {
		$this->id = !empty($data['id']) ? $data['id'] : null;
		$this->artist = !empty($data['artist']) ? $data['artist'] : null;
		$this->title = !empty($data['title']) ? $data['title'] : null;
	}
}