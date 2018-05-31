<?phpclass importclass extends Controller {    public $importModel;    private function fieldsArray($table) {        switch ($table) {            case "village_details":                return $fieldsArray = array('id', 'program', 'village', 'sub_location', 'date', 'time', 'venue', 'field_officer', 'initial_status', 'final_status', 'population', 'quorum', 'prize_quorum', 'people_present', 'won_present', 'elder_name', 'elder_contact', 'chw_name', 'chw_contacts', 'mycyl_allocated', 'directions', 'notes');            case "admin_countries":                return $fieldsArray = array('id', 'country');            case "promoter_details":                return $fieldsArray = array('id', 'country', 'program', 'waterpoint_id', 'promoter_name', 'promoter_gender', 'promoter_contact', 'promoter_language', 'assistant_promoter_name', 'assistant_promoter_gender', 'assistant_promoter_contact', 'assistant_promoter_language', 'unix_timestamp');            case "fleet_list":                return $fieldsArray = array('id', 'country', 'type', 'make', 'model', 'color', 'purchase_date', 'buying_price', 'chassis_no', 'engine_no', 'reg_no', 'office_location');            case "contact_category":                return $fieldsArray = array('id', 'title');            case "staff_category":                return $fieldsArray = array('id', 'position');            case "staff_category":                return $fieldsArray = array('id', 'position');            case 'verification_track':                return $fieldsArray = array('id', 'country', 'program', 'village_name', 'field_officer', 'date_survey_completed', 'waterpoint_name', 'verification_id', 'status', 'reason_for_fail');            case 'vcs_meetings_tracker':                return $fieldsArray = array('id', 'program', 'village_name', 'date', 'time', 'venue', 'field_officer_responsible', 'initial_status', 'final_status', 'population', 'quorum', 'prize_quorum', 'people_present', 'elder_name', 'elder_contact', 'chw_name', 'chw_contacts', 'mycyl_allocated', 'directions', 'notes');            case 'officials_contacts':                return $fieldsArray = array('id', 'country', 'territory_id', 'name', 'title', 'phone', 'email');            case 'village_details2':                return $fieldsArray = array('id', 'country', 'program', 'village_name', 'village_elder', 'elder_contact', 'chw_name', 'chw_contact');            case 'admin_assets':                return $fieldsArray = array('id', 'country', 'inventory_type', 'model', 'serial_no', 'other_identifier', 'item_desc', 'office_location', 'inventory_tag', 'person_responsible', 'quantity', 'purchase_date', 'invoice_number', 'purchase_price_local', 'purchase_price_usd', 'total_usd', 'deprecation_period', 'project', 'category', 'phone_imei', 'battery_serial', 'simcard_number', 'insurance', 'warranty');            case 'cau_programs':                return $fieldsArray = array('id', 'country', 'program', 'territory_id');            case "chlorine_inventory":                return $fieldsArray = array('id', 'country', 'batch_no','vehicle_reg_number', 'inventory_type', 'description','inventory_condition','unit_price','invoice_number','quantity_received', 'quantity_used', 'quantity_spoilt','storage_location', 'date_received', 'expiry_date','last_update');            case 'fleet_log':                return $fieldsArray = array('ID', 'RegNum', 'Date', 'FuelQuant','CurrentFuelRead', 'PreviousFuelRead', 'KilometerCov', 'Kilometer_p_Liter', 'FuelCost', 'AuthPerson', 'AuthSigne','Rider', 'Comment');                                                                                            case 'fleet_maintenance':                return $fieldsArray = array('ID', 'RegNum', 'Date', 'Category','Description', 'OutMater_indicate', 'OutMater_TCost', 'OutLabour', 'Out_work_performed', 'OdometerReading');                                                                                        }    }    public function index($table, $returnClass, $control, $program = null) {        if (isset($program)) {            $siteverificationId = explode('/', $_GET['url']);            $program = $siteverificationId[5];        }        $importModel = $this->loadModel('processmodel');        $fieldsArray = $this->fieldsArray($table);        if ($table == "verification_track") {            $tableName = "Track Verifications";        } else {            $tableName = $table;        }        require 'application/views/_templates/header.php';        require 'application/views/process/expansion/sidebar.php';        require 'application/views/import/index.php';        require 'application/views/_templates/footer.php';    }  public function importCau(){        $generaldata_model = $this->loadModel('generalmodel');            $geography_model = $this->loadModel('caumanagermodel');                function return_bytes($val) {            $val = trim($val);            $last = strtolower($val[strlen($val)-1]);            switch($last) {                // The 'G' modifier is available since PHP 5.1.0                case 'g':                    $val *= 1024;                case 'm':                    $val *= 1024;                case 'k':                    $val *= 1024;            }            return $val;        }        $post_max_size_M = ini_get('post_max_size');        $post_max_size = return_bytes(ini_get('post_max_size'));        if (isset($_POST['import-cau'])) {            if (isset($_FILES['import-cau-csv'])) {                                if ($_FILES["import-cau-csv"]["error"] > 0) {                     echo '<p class="text-danger bg-danger">Error In Uploading</p>';                  }else {                     $temp = $_FILES["import-cau-csv"]["tmp_name"];                     $filename = $this->upload_image($temp);                     $csv = array_map('str_getcsv', file($filename));                     $geography_model->importTerritorryDetails($csv);                  }            }        }      header('Location:'.URL.'caumanager/index');  }  public function fleet($table, $returnClass, $control, $program = null) {        if (isset($program)) {            $siteverificationId = explode('/', $_GET['url']);            $program = $siteverificationId[5];        }        $importModel = $this->loadModel('processmodel');        $fieldsArray = $this->fieldsArray($table);        if ($table == "verification_track") {            $tableName = "Track Verifications";        } else {            $tableName = $table;        }        require 'application/views/_templates/header.php';        require 'application/views/adminData/sidebar.php';        require 'application/views/import/index.php';        require 'application/views/_templates/footer.php';    }    public function import($table, $returnClass, $control, $program = null) {        if (isset($program)) {            $siteverificationId = explode('/', $_GET['url']);             $program = $siteverificationId[5];            //exit();        }        $importmodel = $this->loadModel('expansionmodel');        $status = $this->upload($table, $program);        if ($program == null) {            header("Location:" . URL . $returnClass . "/" . $control . "/" . $table . "/?message=" . urlencode($status));        } else {            header("Location:" . URL . $returnClass . "/" . $control . "/" . $program . "/?message=" . urlencode($status));        }    }    public function importOfficials($table, $returnClass, $control, $program = null) {        $importmodel = $this->loadModel('expansionmodel');        $status = $this->uploadOfficials($table, $program);        header("Location:" . URL . "generalclass/Officials/officials_contacts/?message=" . urlencode($status));    }    public function importVillages($table, $returnClass, $control, $program = null) {        $importmodel = $this->loadModel('expansionmodel');        $status = $this->uploadVillages($table, $program);        header("Location:" . URL . "generalclass/villageContacts/village_details/?message=" . urlencode($status));    }    public function importAssets($table, $returnClass, $control, $program = null) {        $importmodel = $this->loadModel('expansionmodel');        $status = $this->uploadAssets($table, $program);        header("Location:" . URL . "assetData/asset/?message=" . urlencode($status));    }    public function importCauPrograms($table, $returnClass, $control) {        $importmodel = $this->loadModel('expansionmodel');        $status = $this->uploadCauPrograms($table);        header("Location:" . URL . "generalclass/cauPrograms/?message=" . urlencode($status));    }    public function upload($table, $program = null) {        ini_set('max_execution_time', 3000);        if ($_FILES["file"]["error"] > 0) {            $status = 'Failed Upload';        } else {            $temp = $_FILES["file"]["tmp_name"];            $filename = $this->upload_image($temp);            $status = $this->setCsv($filename, $table, $program);        }        return $status;    }    public function uploadOfficials($table, $program = null) {        ini_set('max_execution_time', 3000);        if ($_FILES["file"]["error"] > 0) {            $status = 'Failed Upload';        } else {            $temp = $_FILES["file"]["tmp_name"];            $filename = $this->upload_image($temp);            $status = $this->setOfficialsCsv($filename, $table, $program);        }        return $status;    }    public function uploadVillages($table, $program = null) {        ini_set('max_execution_time', 3000);        if ($_FILES["file"]["error"] > 0) {            $status = 'Failed Upload';        } else {            $temp = $_FILES["file"]["tmp_name"];            $filename = $this->upload_image($temp);            $status = $this->setVillageCsv($filename, $table, $program);        }        return $status;    }    public function uploadAssets($table, $program = null) {        ini_set('max_execution_time', 3000);        if ($_FILES["file"]["error"] > 0) {            $status = 'Failed Upload';        } else {            $temp = $_FILES["file"]["tmp_name"];            $filename = $this->upload_image($temp);            $status = $this->setAssetsCsv($filename, $table, $program);        }        return $status;    }    public function uploadCauPrograms($table) {        ini_set('max_execution_time', 3000);        if ($_FILES["file"]["error"] > 0) {            $status = 'Failed Upload';        } else {            $temp = $_FILES["file"]["tmp_name"];            $filename = $this->upload_image($temp);            $status = $this->setCauProgramsCsv($filename, $table);        }        return $status;    }    public function upload_image($image_temp) {        $album_name = substr(sha1(uniqid('moreentropyhere')), 0, 10);        $image_file = $album_name . '.csv';        $path = __DIR__ . '/upload/ ' . $image_file;        //$path = str_replace('\\', '\\\\', $path);        move_uploaded_file($image_temp, $path);        return $path;    }    public function setCsv($filename, $tableName, $program = null) {        $importmodel = $this->loadModel('expansionmodel');        $fieldsArray = $this->fieldsArray($tableName);        $handle = fopen($filename, "r");        $counter = 0;        $fieldNo = sizeof($fieldsArray);        $counter1 = 0;        $permanentState = 0;        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {            // echo "CSV Size is ".sizeof($data) ;            // echo $tableName;            // echo "Fields Array Size is ".sizeof($fieldsArray) ;            // exit();            if (sizeof($data) == sizeof($fieldsArray)) {                $data3 = array();                $status = 'ok';                foreach ($fieldsArray as $key => $value) {                    if ($value == "country") {                        $data3[$value] = $_SESSION['country'];                    } else if ($value == "id") {                        $data3[$value] = '';                    } else if ($value == "inventory_type" && $tableName =="chlorine_inventory") {                        $type=$importmodel->getChlorineInventory($data[$counter1]);                        $data3[$value]=$type>0?$type:1;                    } else if ($value == "program" && $program != null) {                        $data3[$value] = $program;                    } else if ($value == 'village' || $value == 'village_name') {                        $villageId = $importmodel->getVillageId($data[$counter1]);                        $villageId = isset($villageId[0]["id"]) ? $villageId[0]["id"] : null;                        if ($villageId != null) {                            $data3[$value] = $villageId;                        } else {                            $status = 'Cancel';                            $permanentState+=1;                        }                    } else {                        $data3[$value] = $data[$counter1];                    }                    ++$counter1;                }                $counter1 = 0;//                echo '<pre>';////                print_r($data3);////                echo '<pre>';                                if ($counter != 0 && $status == 'ok') {                    $importmodel->insertdDB($tableName, $data3);                }                ++$counter;                if ($permanentState > 1 && $counter != 0) {                    $actualcounter = $counter - 1;                    $status = 'Some Records have uploaded.<br/>Unfortunately ' . $permanentState . ' out of ' . $actualcounter . ' uploaded Record(s) failed to upload. ';                } else {                    $status = 'Upload Successful';                }            } else {                $status = 'Failed to Upload';            }        }        fclose($handle);        return $status;    }    public function setOfficialsCsv($filename, $tableName, $program = null) {        $importmodel = $this->loadModel('expansionmodel');        $fieldsArray = $this->fieldsArray($tableName);        $handle = fopen($filename, "r");        $counter = 0;        $fieldNo = sizeof($fieldsArray);        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {            if (sizeof($data) == sizeof($fieldsArray) + 1) {                $data3 = array();                $status = 'ok';                foreach ($fieldsArray as $key => $value) {                    if ($value == "country") {                        $data3[$value] = $_SESSION['country'];                    }                    if ($value == "title") {                        $titleId = $importmodel->getTitle($data[3]);                        if ($titleId != null) {                            $data3[$value] = $titleId[0]['id'];                        }                    }                    if ($value == "territory_id") {                        $territory = $importmodel->getTerritoryId($data[6], $data[7]);                        if ($territory != null) {                            $data3[$value] = $territory[0]["id"];                        }                    }                    if ($value == "name") {                        $data3[$value] = $data[2];                    }                    if ($value == "phone") {                        $data3[$value] = $data[4];                    }                    if ($value == "email") {                        $data3[$value] = $data[5];                    }                    if ($value == "id") {                        $data3[$value] = '';                    }                }                if (array_key_exists("name", $data3)) {                                    } else {                    echo $status = "Cancel";                }                if (array_key_exists("email", $data3)) {                                    } else {                    echo $status = "Cancel";                }                if (array_key_exists("title", $data3)) {                                    } else {                    echo $status = "Cancel";                }                $counter1 = 0;                if ($counter != 0 && $status == 'ok') {                    $importmodel->insertdDB($tableName, $data3);                    $status = 'Upload Successful';                }                ++$counter;            } else {                $status = 'Failed to Upload';            }        }        fclose($handle);        return $status;    }    public function setVillageCsv($filename, $tableName, $program = null) {        $importmodel = $this->loadModel('expansionmodel');        $fieldsArray = $this->fieldsArray('village_details2');        $handle = fopen($filename, "r");        $counter = 0;        $fieldNo = sizeof($fieldsArray);        $counter1 = 0;        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {            if (sizeof($data) == sizeof($fieldsArray)) {                $data3 = array();                $status = 'ok';                foreach ($fieldsArray as $key => $value) {                    if ($value == "country") {                        $data3[$value] = $_SESSION['country'];                    } else if ($value == "id") {                        $data3[$value] = '';                    } else if ($value == 'village' || $value == 'village_name') {                        $villageId = $importmodel->getVillageId($data[$counter1]);                        $villageId = isset($villageId[0]["id"]) ? $villageId[0]["id"] : null;                        if ($villageId != null) {                            $data3[$value] = $villageId;                        } else {                            $status = 'Cancel';                        }                    } else {                        $data3[$value] = $data[$counter1];                    }                    ++$counter1;                }                $counter1 = 0;                if ($counter != 0 && $status == 'ok') {                    $importmodel->insertdDB($tableName, $data3);                }                ++$counter;                $status = 'Upload Successful';            } else {                $status = 'Failed to Upload';            }        }        fclose($handle);        return $status;    }    public function setAssetsCsv($filename, $tableName, $program = null) {        $importmodel = $this->loadModel('expansionmodel');        $fieldsArray = $this->fieldsArray($tableName);        $handle = fopen($filename, "r");        $counter = 0;        $fieldNo = sizeof($fieldsArray);        $counter1 = 0;        $permanentState = 0;        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {            if (sizeof($data) == sizeof($fieldsArray)) {                $data3 = array();                $status = 'ok';                foreach ($fieldsArray as $key => $value) {                    if ($value == "country") {                        $data3[$value] = $_SESSION['country'];                    } else if ($value == "id") {                        $data3[$value] = '';                    } else if ($value == "office_location") {                        $officeName = $importmodel->getOfficeName($data[$counter1]);                        if (($officeName == null || $officeName == 0) && $counter != 0) {                            $permanentState+=1;                            $status = 'Not Ok';                        } else if ($counter != 0) {                            $data3[$value] = $officeName[0]['id'];                        }                    } else if ($value == "inventory_type") {                        $inventoryId = $importmodel->getInventoryId($data[$counter1]);                        if (($inventoryId == null || $inventoryId == 0) && $counter != 0) {                            $permanentState+=1;                            $status = 'Not Ok';                        } else if ($counter != 0) {                            $data3[$value] = $inventoryId[0]['id'];                        }                    } else {                        $data3[$value] = $data[$counter1];                    }                    ++$counter1;                }                $counter1 = 0;                if ($counter != 0 && $status == 'ok') {                    $importmodel->insertdDB($tableName, $data3);                }                ++$counter;                if ($permanentState > 1 && $counter != 0) {                    $actualcounter = $counter - 1;                    $status = 'Some Records have uploaded.<br/>Unfortunately ' . $permanentState . ' errors out of ' . $actualcounter . ' uploaded Record(s) Appeared either because: <br/>1. You failed to follow the import structure.<br/>2.You included an office Name/inventory type that is not in the system. ';                } else {                    $status = 'Upload Successful';                }            } else {                $status = 'Failed to Upload';            }        }        fclose($handle);        return $status;    }    public function setCauProgramsCsv($filename, $tableName) {        $importmodel = $this->loadModel('expansionmodel');        $fieldsArray = $this->fieldsArray($tableName);        $handle = fopen($filename, "r");        $counter = 0;        $fieldNo = sizeof($fieldsArray);        $counter1 = 0;        $permanentState = 0;        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {            if (sizeof($data) == sizeof($fieldsArray)) {                $data3 = array();                $status = 'ok';                foreach ($fieldsArray as $key => $value) {                    if ($value == "country") {                        $data3[$value] = $_SESSION['country'];                    } else if ($value == "id") {                        $data3[$value] = '';                    } else if ($value == "program" && $data[$counter1] != strtolower('program')) {                        $programId = $importmodel->checkProgramExist($data[$counter1]);                        if ($programId != 0) {                            $data3[$value] = $programId;                        } else {                            $status = 'Not Ok';                        }                    } else if ($value == "program" && strtolower($data[$counter1]) == strtolower('program')) {                        $status = 'Not Ok';                    } else if ($value == "territory_id") {                        $villageId = $importmodel->getVillageId($data[$counter1]);                        if (isset($villageId[0]['id']) && $villageId != 0) {                            $territoryId = $importmodel->checkTerritoryExist($villageId[0]['id']);                            if (sizeof($territoryId) != 0) {                                $status = 'Not Ok';                                $permanentState+=1;                            } else {                                $data3[$value] = $villageId[0]['id'];                            }                        } else {                            $data3[$value] = '';                            $permanentState+=1;                            $status = 'Not Ok';                        }                    } else {                        $data3[$value] = $data[$counter1];                    }                    ++$counter1;                }                $counter1 = 0;                if ($counter != 0 && $status == 'ok') {                    $importmodel->insertdDB($tableName, $data3);                }                ++$counter;                if ($permanentState > 1 && $counter != 0) {                    $actualcounter = $counter - 1;                    $status = 'Some Records have uploaded.<br/>Unfortunately ' . $permanentState . ' errors out of ' . $actualcounter . ' uploaded Record(s) Appeared, resulting in some records not being saved,either because: <br/>1. You failed to follow the import structure.<br/>2.You included a C.A.U that is not in the system.<br/>3.The Territory has already been assigned a program ';                } else {                    $status = 'Upload Successful';                }            } else {                $status = 'Failed to Upload';            }        }        fclose($handle);        return $status;    }}?>  