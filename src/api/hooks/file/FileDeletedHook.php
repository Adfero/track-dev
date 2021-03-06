<?php
/**
 * Created by Daniel Vidmar.
 * Date: 4/25/2015
 * Time: 1:17 AM
 * Version: Beta 2
 * Last Modified: 4/25/2015 at 1:17 AM
 * Last Modified by Daniel Vidmar.
 */

class FileDeletedHook extends FileHook {

    public function __construct($project = 'not initialized', $version = 'not initialized', $file_name = 'not initialized', $id = 'not initialized') {
        parent::__construct("file_deleted_hook");
        $this->web = true;
        $this->arguments = array(
            'project' => $project,
            'version' => $version,
            'file_name' => $file_name,
            'id' => $id
        );
    }
}