<?php
require "application/modules/album/models/DbTable/Album.php";

class Album_Model_AlbumMapper
{

	protected $_dbTable;
	
	public function setDbTable($dbTable)
	{
		if (is_string($dbTable)) {
			$dbTable = new $dbTable();
		}
		if (!$dbTable instanceof Zend_Db_Table_Abstract) {
			throw new Exception('Invalid table data gateway provided');
		}
		$this->_dbTable = $dbTable;
		return $this;
	}
	
	public function getDbTable()
	{
		if (null === $this->_dbTable) {
			$this->setDbTable('Album_Model_DbTable_Album');
		}
		return $this->_dbTable;
	}
	
	/* album function CRUD */
	
	public function fetchAll()
	{
		$resultSet = $this->getDbTable()->fetchAll();
		return $resultSet;
	}
	
	
	public function getAlbum($id)
	{
		$id  = (int) $id;
		$rowset = $this->_dbTable->select(array('id' => $id));
		$row = $rowset->current();
		if (!$row) {
			throw new \Exception("Could not find row $id");
		}
		return $row;
	}
	
	public function saveAlbum(Album $album)
	{
		$data = array(
				'artist' => $album->artist,
				'title'  => $album->title,
		);
	
		$id = (int) $album->id;
		if ($id == 0) {
			$this->_dbTable->insert($data);
		} else {
			if ($this->getAlbum($id)) {
				$this->_dbTable->update($data, array('id' => $id));
			} else {
				throw new \Exception('Album id does not exist');
			}
		}
	}
	
	public function deleteAlbum($id)
	{
		$this->_dbTable->delete(array('id' => (int) $id));
	}
	
}

