<?php/** * Created by Daniel Vidmar. * Date: 10/27/14 * Time: 12:59 AM * Version: Beta 2 * Last Modified: 10/27/14 at 12:59 AM * Last Modified by Daniel Vidmar. */if(isset($_POST['add-version'])) {	if(isset($_POST['project']) && trim($_POST['project']) != "") {		if(isset($_POST['version-name']) && trim($_POST['version-name']) != "") {			if(!VersionFunc::exists(cleanInput($_POST['version-name']))) {				if(isset($_POST['status']) && trim($_POST['status']) != "") {					if(isset($_POST['version-type']) && trim($_POST['version-type']) != "") {						if(isset($_POST['captcha']) && trim($_POST['captcha']) != '' && checkCaptcha(cleanInput($_POST['captcha']))) {							$version = cleanInput($_POST['version-name']);							$project = cleanInput($_POST['project']);							$status = cleanInput($_POST['status']);							$type = cleanInput($_POST['version-type']);														if(isset($_POST['version_download'])) {								uploadFile($_FILES['version_download'], $project."-".$version);							}							$due = (isset($_POST['due-date']) && trim($_POST['due-date']) != "") ? cleanInput($_POST['due-date']) : "0000-00-00";							VersionFunc::add($version, $project, $status, $due, '0000-00-00', $type);							destroySession("userspluscaptcha");						} else {							echo '<script type="text/javascript">';							echo 'showMessage("error", "'.$formatter->replaceShortcuts($langmanager->getValue($language, "site->forms->invalidcaptcha")).'");';							echo '</script>';						}					} else {						echo '<script type="text/javascript">';						echo 'showMessage("error", "'.$formatter->replaceShortcuts($langmanager->getValue($language, "site->forms->version->notype")).'");';						echo '</script>';					}				} else {					echo '<script type="text/javascript">';					echo 'showMessage("error", "'.$formatter->replaceShortcuts($langmanager->getValue($language, "site->forms->task->invalidstatus")).'");';					echo '</script>';				}			} else {				echo '<script type="text/javascript">';				echo 'showMessage("error", "'.$formatter->replaceShortcuts($langmanager->getValue($language, "site->forms->version->taken")).'");';				echo '</script>';			}		} else {			echo '<script type="text/javascript">';			echo 'showMessage("error", "'.$formatter->replaceShortcuts($langmanager->getValue($language, "site->forms->project->noname")).'");';			echo '</script>';		}	} else {		echo '<script type="text/javascript">';		echo 'showMessage("error", "'.$formatter->replaceShortcuts($langmanager->getValue($language, "site->forms->list->noproject")).'");';		echo '</script>';	}}if(isset($_POST['edit-version'])) {	if(isset($_POST['id']) && trim($_POST['id']) != "") {		$details = VersionFunc::getDetails(cleanInput($_POST['id']));		if(isset($_POST['project']) && trim($_POST['project']) != "") {			if(isset($_POST['version-name']) && trim($_POST['version-name']) != "") {				if($details['name'] == cleanInput($_POST['version-name']) || $details['name'] != cleanInput($_POST['version-name']) && !VersionFunc::exists(cleanInput($_POST['version-name']))) {					if(isset($_POST['status']) && trim($_POST['status']) != "") {						if(isset($_POST['version-type']) && trim($_POST['version-type']) != "") {							if(isset($_POST['captcha']) && trim($_POST['captcha']) != '' && checkCaptcha(cleanInput($_POST['captcha']))) {								$id = cleanInput($_POST['id']);								$version = cleanInput($_POST['version-name']);								$project = cleanInput($_POST['project']);								$status = cleanInput($_POST['status']);								$type = cleanInput($_POST['version-type']);								$due = (isset($_POST['due-date']) && trim($_POST['due-date']) != "") ? cleanInput($_POST['due-date']) : "0000-00-00";																VersionFunc::edit($id, $version, $project, $status, $due, '0000-00-00', $type);																destroySession("userspluscaptcha");							} else {								echo '<script type="text/javascript">';								echo 'showMessage("error", "'.$formatter->replaceShortcuts($langmanager->getValue($language, "site->forms->invalidcaptcha")).'");';								echo '</script>';							}						} else {							echo '<script type="text/javascript">';							echo 'showMessage("error", "'.$formatter->replaceShortcuts($langmanager->getValue($language, "site->forms->version->notype")).'");';							echo '</script>';						}					} else {						echo '<script type="text/javascript">';						echo 'showMessage("error", "'.$formatter->replaceShortcuts($langmanager->getValue($language, "site->forms->task->invalidstatus")).'");';						echo '</script>';					}				} else {					echo '<script type="text/javascript">';					echo 'showMessage("error", "'.$formatter->replaceShortcuts($langmanager->getValue($language, "site->forms->version->taken")).'");';					echo '</script>';				}			} else {				echo '<script type="text/javascript">';				echo 'showMessage("error", "'.$formatter->replaceShortcuts($langmanager->getValue($language, "site->forms->project->noname")).'");';				echo '</script>';			}		} else {			echo '<script type="text/javascript">';			echo 'showMessage("error", "'.$formatter->replaceShortcuts($langmanager->getValue($language, "site->forms->list->noproject")).'");';			echo '</script>';		}	} else {		echo '<script type="text/javascript">';        echo 'showMessage("error", "'.$formatter->replaceShortcuts($langmanager->getValue($language, "site->forms->invalidid")).'");';        echo '</script>';    }}?>