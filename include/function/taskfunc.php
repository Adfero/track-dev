<?php
/**
 * Created by Daniel Vidmar.
 * Date: 12/13/13
 * Time: 9:30 AM
 * Version: Beta 1
 * Last Modified: 1/15/14 at 1:05 PM
 * Last Modified by Daniel Vidmar.
 */

//Include the Connect Class
require_once("include/connect.php");
class TaskFunc {

    //add task
    public static function add($project, $list, $title, $description, $author, $assignee, $created, $due, $finish, $version, $labels, $editable, $status, $progress) {
        $connect = new Connect();
        $c = $connect->connection;
        $t = $connect->prefix."_".$project."_".$list;
        $stmt = $c->prepare("INSERT INTO `".$t."` (id, title, description, author, assignee, due, created, finished, versionname, labels, editable, taskstatus, progress) VALUES('', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $title);
        $stmt->bindParam(2, $description);
        $stmt->bindParam(3, $author);
        $stmt->bindParam(4, $assignee);
        $stmt->bindParam(5, $due);
        $stmt->bindParam(6, $created);
        $stmt->bindParam(7, $finish);
        $stmt->bindParam(8, $version);
        $stmt->bindParam(9, $labels);
        $stmt->bindParam(10, $editable);
        $stmt->bindParam(11, $status);
        $stmt->bindParam(12, $progress);
        $stmt->execute();
    }

    //delete task
    public static function delete($project, $list, $id) {
        $connect = new Connect();
        $c = $connect->connection;
        $t = $connect->prefix."_".$project."_".$list;
        $stmt = $c->prepare("DELETE FROM `".$t."` WHERE id = ?");
        $stmt->bindParam(1, $id);
        $stmt->execute();
    }

    //check task table
    public static function checkTable($project, $list) {
        $connect = new Connect();
        $c = $connect->connection;
        $t = $connect->prefix."_".$project."_".$list;
    }

    //edit task
    public static function edit($id, $project, $list, $title, $description, $author, $assignee, $created, $due, $finish, $version, $labels, $editable, $status, $progress) {
        $connect = new Connect();
        $c = $connect->connection;
        $t = $connect->prefix."_".$project."_".$list;
        $stmt = $c->prepare("UPDATE `".$t."` SET title = ?, description = ?, author = ?, assignee = ?, due = ?, created = ?, finished = ?, versionname = ?, labels = ?, editable = ?, taskstatus = ?, progress = ? WHERE id = ?");
        $stmt->bindParam(1, $title);
        $stmt->bindParam(2, $description);
        $stmt->bindParam(3, $author);
        $stmt->bindParam(4, $assignee);
        $stmt->bindParam(5, $due);
        $stmt->bindParam(6, $created);
        $stmt->bindParam(7, $finish);
        $stmt->bindParam(8, $version);
        $stmt->bindParam(9, $labels);
        $stmt->bindParam(10, $editable);
        $stmt->bindParam(11, $status);
        $stmt->bindParam(12, $progress);
        $stmt->bindParam(13, $id);
        $stmt->execute();
    }

    public static function getDetails($project, $list, $id) {
        $return = array();
        $connect = new Connect();
        $c = $connect->connection;
        $t = $connect->prefix."_".$project."_".$list;
        $stmt = $c->prepare("SELECT title, description, author, assignee, due, created, finished, versionname, labels, editable, taskstatus, progress FROM `".$t."` WHERE id = ?");
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $return['title'] = $result['title'];
        $return['description'] = $result['description'];
        $return['author'] = $result['author'];
        $return['assignee'] = $result['assignee'];
        $return['due'] = $result['due'];
        $return['created'] = $result['created'];
        $return['finished'] = $result['finished'];
        $return['version'] = $result['versionname'];
        $return['labels'] = $result['labels'];
        $return['editable'] = $result['editable'];
        $return['status'] = $result['taskstatus'];
        $return['progress'] = $result['progress'];
        return $return;
    }

    //change task assignee
    public static function changeAssignee($project, $list, $id, $assignee) {
        $connect = new Connect();
        $c = $connect->connection;
        $t = $connect->prefix."_".$project."_".$list;
        $stmt = $c->prepare("UPDATE `".$t."` SET assignee = ? WHERE id = ?");
        $stmt->bindParam(1, $assignee);
        $stmt->bindParam(2, $id);
        $stmt->execute();
    }

    //change task labels
    public static function changeLabels($project, $list, $id, $labels) {
        $connect = new Connect();
        $c = $connect->connection;
        $t = $connect->prefix."_".$project."_".$list;
        $stmt = $c->prepare("UPDATE `".$t."` SET labels = ? WHERE id = ?");
        $stmt->bindParam(1, $labels);
        $stmt->bindParam(2, $id);
        $stmt->execute();
    }

    //change task list
    public static function changeList($project, $list, $id, $newList) {
        $connect = new Connect();
        $c = $connect->connection;
        $t = $connect->prefix."_".$project."_".$list;
        //use INTO SELECT
    }

    //change task progress
    public static function changeProgress($project, $list, $id, $progress) {
        $connect = new Connect();
        $c = $connect->connection;
        $t = $connect->prefix."_".$project."_".$list;
        $stmt = $c->prepare("UPDATE `".$t."` SET progress = ? WHERE id = ?");
        $stmt->bindParam(1, $progress);
        $stmt->bindParam(2, $id);
        $stmt->execute();
    }

    //change project
    public static function changeProject($project, $list, $id, $newProject) {
        $connect = new Connect();
        $c = $connect->connection;
        $t = $connect->prefix."_".$project."_".$list;
        //use INTO SELECT
    }

    public static function changeFinished($project, $list, $id, $finished) {
        $connect = new Connect();
        $c = $connect->connection;
        $t = $connect->prefix."_".$project."_".$list;
        $stmt = $c->prepare("UPDATE `".$t."` SET finished = ? WHERE id = ?");
        $stmt->bindParam(1, $finished);
        $stmt->bindParam(2, $id);
        $stmt->execute();
    }

    //change task status
    public static function changeStatus($project, $list, $id, $status) {
        $connect = new Connect();
        $c = $connect->connection;
        $t = $connect->prefix."_".$project."_".$list;
        $stmt = $c->prepare("UPDATE `".$t."` SET taskstatus = ? WHERE id = ?");
        $stmt->bindParam(1, $status);
        $stmt->bindParam(2, $id);
        $stmt->execute();
    }

    //change task title
    public static function changeTitle($project, $list, $id, $title) {
        $connect = new Connect();
        $c = $connect->connection;
        $t = $connect->prefix."_".$project."_".$list;
        $stmt = $c->prepare("UPDATE `".$t."` SET title = ? WHERE id = ?");
        $stmt->bindParam(1, $title);
        $stmt->bindParam(2, $id);
        $stmt->execute();
    }

    //change task version
    public static function changeVersion($project, $list, $id, $version) {
        $connect = new Connect();
        $c = $connect->connection;
        $t = $connect->prefix."_".$project."_".$list;
        $stmt = $c->prepare("UPDATE `".$t."` SET versionname = ? WHERE id = ?");
        $stmt->bindParam(1, $version);
        $stmt->bindParam(2, $id);
        $stmt->execute();
    }

    public static function hasLabel($project, $list, $id, $label) {
        $connect = new Connect();
        $c = $connect->connection;
        $t = $connect->prefix."_".$project."_".$list;
        $stmt = $c->prepare("SELECT labels FROM `".$t."` WHERE id = ?");
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $labelstring = $result['labels'];
        $labels = explode(',', $labelstring);

        foreach($labels as &$l) {
            if($l != "" && $l == $label) {
                return true;
            }
        }
        return false;
    }

    public static function printAddForm($project, $list, $username) {
        $out = '';
        $out .= '<h3>Add Task</h3>';
        $out .= '<div id="holder">';
        $out .= '<div id="page_1">';
        $out .= '<fieldset id="inputs">';
        $out .= '<input id="title" name="title" type="text" placeholder="Title">';
        $out .= '<textarea id="description" name="description" ROWS="3" COLS="40"></textarea>';
        $out .= '<input id="author" name="author" type="hidden" value="'.$username.'">';
        $out .= '<label for="assignee">Assignee:</label>';
        $out .= '<select name="assignee" id="assignee">';
        $out .= '<option value="none" selected>None</option>';
        $users = UserFunc::users();
        foreach($users as &$user) {
            $out .= '<option value="'.$user.'">'.$user.'</option>';
        }
        $out .= '</select>';
        //TODO: Add due date field
        $out .= '</fieldset>';
        $out .= '<fieldset id="links">';
        $out .= '<button class="submit" onclick="switchPage(event, \'page_1\', \'page_2\'); return false;">Next</button>';
        $out .= '</fieldset>';
        $out .= '</div>';
        $out .= '<div id="page_2">';
        $out .= '<fieldset id="inputs">';
        $out .= '<label for="editable">Editable:</label>';
        $out .= '<select name="editable" id="editable">';
        $out .= '<option value="0">No</option>';
        $out .= '<option value="1" selected>Yes</option>';
        $out .= '</select><br />';
        $out .= '<label for="status">Status:</label>';
        $out .= '<select name="status" id="status">';
        $out .= '<option value="0" selected>None</option>';
        $out .= '<option value="1">Done</option>';
        $out .= '<option value="2">In Progress</option>';
        $out .= '<option value="3">Closed</option>';
        $out .= '</select><br />';
        $out .= '<label for="progress">Progress:<label id="progress_value">0</label></label><br />';
        $out .= '<input type="range" id="progress" name="progress" value="0" min="0" max="100" oninput="showValue(\'progress_value\', this.value);">';
        $out .= '</fieldset>';
        $out .= '<fieldset id="links">';
        $out .= '<button class="submit_2" onclick="switchPage(event, \'page_2\', \'page_1\'); return false;">Back</button>';
        $out .= '<button class="submit" onclick="switchPage(event, \'page_2\', \'page_3\'); return false;">Next</button>';
        $out .= '</fieldset>';
        $out .= '</div>';
        $out .= '<div id="page_3">';
        $out .= '<fieldset id="inputs">';
        $out .= '<div class="labels-field">';
        $out .= '<div style="width:100%;height:auto;text-align:center;"><b><label class="center">Labels</label></b></div>';
        $out .= '<div style="width:100%;height:auto;margin 5px 0;">';
        $out .= '<label class="fmleft">Available</label>';
        $out .= '<label class="fmright">Chosen</label>';
        $out .= '<div class="clear"></div>';
        $out .= '</div>';
        $out .= '<div id="labels-available" class="labels-left" ondrop="onDrop(event)" ondragover="onDragOver(event)" style="margin:0;">';
        $labels = LabelFunc::labels($project, $list);
        foreach($labels as &$label) {
            $out .= '<div id="label-'.$label['id'].'" class="list-label small-label" style="background:'.$label['background'].';color:'.$label['text'].';border:1px solid '.$label['text'].';" draggable="true" ondragstart="onDrag(event)">'.$label['label'].'</div>';
        }
        $out .= '</div>';
        $out .= '<div id="labels-chosen" class="labels-right" ondrop="onDrop(event)" ondragover="onDragOver(event)" style="margin:0;height:125px;max-height:125px;overflow-y:scroll;">';
        $out .= '</div>';
        $out .= '<input id="labels-input" name="labels" type="hidden" value="">';
        $out .= '<div class="clear"></div>';
        $out .= '</div>';
        //TODO: print out versions for this project.
        $out .= '</fieldset>';
        $out .= '<fieldset id="links">';
        $out .= '<button class="submit_2" onclick="switchPage(event, \'page_3\', \'page_2\'); return false;">Back</button>';
        $out .= '<input type="submit" class="submit" name="add" value="Add">';
        $out .= '</fieldset>';
        $out .= '</div>';
        $out .= '</div>';

        return $out;
    }

    public static function printEditForm($project, $list, $id) {
        $details = self::getDetails($project, $list, $id);

        $out = '';
        $out .= '<h3>Edit Task</h3>';
        $out .= '<div id="holder">';
        $out .= '<div id="page_1">';
        $out .= '<fieldset id="inputs">';
        $out .= '<input name="id" type="hidden" value="'.$id.'">';
        $out .= '<input id="title" name="title" type="text" value="'.$details['title'].'" placeholder="Title">';
        $out .= '<textarea id="description" name="description" ROWS="3" COLS="40">'.$details['description'].'</textarea>';
        $out .= '<input id="author" name="author" type="hidden" value="'.$details['author'].'">';
        $out .= '<label for="assignee">Assignee:</label>';
        $out .= '<select name="assignee" id="assignee">';
        $selected = ($details['assignee'] == 'none') ? 'selected' : '';
        $out .= '<option value="none" '.$selected.'>None</option>';
        $users = UserFunc::users();
        foreach($users as &$user) {
            $selected = ($details['assignee'] == $user) ? 'selected' : '';
            $out .= '<option value="'.$user.'" '.$selected.'>'.$user.'</option>';
        }
        $out .= '</select>';
        //TODO: Add due date field
        $out .= '</fieldset>';
        $out .= '<fieldset id="links">';
        $out .= '<button class="submit" onclick="switchPage(event, \'page_1\', \'page_2\'); return false;">Next</button>';
        $out .= '</fieldset>';
        $out .= '</div>';
        $out .= '<div id="page_2">';
        $out .= '<fieldset id="inputs">';
        $out .= '<label for="editable">Editable:</label>';
        $out .= '<select name="editable" id="editable">';
        $out .= '<option value="0" ';
        $out .= ($details['editable'] == 0) ? "selected" : "";
        $out .= '>No</option>';
        $out .= '<option value="1" ';
        $out .= ($details['editable'] == 1) ? "selected" : "";
        $out .= '>Yes</option>';
        $out .= '</select><br />';
        $out .= '<label for="status">Status:</label>';
        $out .= '<select name="status" id="status">';
        $out .= '<option value="0" ';
        $out .= ($details['status'] == 0) ? "selected" : "";
        $out .= '>None</option>';
        $out .= '<option value="1" ';
        $out .= ($details['status'] == 1) ? "selected" : "";
        $out .= '>Done</option>';
        $out .= '<option value="2" ';
        $out .= ($details['status'] == 2) ? "selected" : "";
        $out .= '>In Progress</option>';
        $out .= '<option value="3" ';
        $out .= ($details['status'] == 3) ? "selected" : "";
        $out .= '>Closed</option>';
        $out .= '</select><br />';
        $out .= '<label for="progress">Progress:<label id="progress_value">'.$details['progress'].'</label></label><br />';
        $out .= '<input type="range" id="progress" name="progress" value="'.$details['progress'].'" min="0" max="100" oninput="showValue(\'progress_value\', this.value);">';
        $out .= '</fieldset>';
        $out .= '<fieldset id="links">';
        $out .= '<button class="submit_2" onclick="switchPage(event, \'page_2\', \'page_1\'); return false;">Back</button>';
        $out .= '<button class="submit" onclick="switchPage(event, \'page_2\', \'page_3\'); return false;">Next</button>';
        $out .= '</fieldset>';
        $out .= '</div>';
        $out .= '<div id="page_3">';
        $out .= '<fieldset id="inputs">';
        $out .= '<div class="labels-field">';
        $out .= '<div style="width:100%;height:auto;text-align:center;"><b><label class="center">Labels</label></b></div>';
        $out .= '<div style="width:100%;height:auto;margin 5px 0;">';
        $out .= '<label class="fmleft">Available</label>';
        $out .= '<label class="fmright">Chosen</label>';
        $out .= '<div class="clear"></div>';
        $out .= '</div>';
        $out .= '<div id="labels-available-edit" class="labels-left" ondrop="onDrop(event)" ondragover="onDragOver(event)" style="margin:0;">';
        $containedLabels = array();
        $labelsValue = "";
        $labels = LabelFunc::labels($project, $list);
        foreach($labels as &$label) {
            $labelString = '<div id="label-'.$label['id'].'" class="list-label small-label" style="background:'.$label['background'].';color:'.$label['text'].';border:1px solid '.$label['text'].';" draggable="true" ondragstart="onDrag(event)">'.$label['label'].'</div>';
            if(!self::hasLabel($project, $list, $id, $label['id'])) {
                $out .= $labelString;
            } else {
                $containedLabels[] = $labelString;
                $labelsValue .= ($labelsValue != "") ? ",".$label['id'] : $label['id'];
            }
        }
        $out .= '</div>';
        $out .= '<div id="labels-chosen-edit" class="labels-right" ondrop="onDrop(event)" ondragover="onDragOver(event)" style="margin:0;height:125px;max-height:125px;overflow-y:scroll;">';
        foreach($containedLabels as &$label) {
            $out .= $label;
        }
        $out .= '</div>';
        $out .= '<input id="labels-input" name="labels-edit" type="hidden" value="'.$labelsValue.'">';
        $out .= '<div class="clear"></div>';
        $out .= '</div>';
        $out .= '</fieldset>';
        $out .= '<fieldset id="links">';
        $out .= '<button class="submit_2" onclick="switchPage(event, \'page_3\', \'page_2\'); return false;">Back</button>';
        $out .= '<input type="submit" class="submit" name="edit" value="Submit">';
        $out .= '</fieldset>';
        $out .= '</div>';
        $out .= '</div>';

        return $out;
    }
}
?>