 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Schedule_master extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        $this->load->model("global_model");
        $this->load->model("contract_model");
        $this->load->model("schedule_model");
    }

    public function index()
    {   
        priv("view");
        $data["page"]       = "schedule/master/view";
        $data["title"]      = "Manage Assignment";
        $data["data"]       = $this->schedule_model->get_data();
        $this->load->view('admin',$data);
    }

    public function detail($id)
    {   
        priv("view");
        $data["page"]           = "schedule/master/detail";
        $data["title"]          = "Detail Service";
        $data['data']           = $this->schedule_model->get_data_schedule($id);
        // echo "<pre>"; print_r($data['data']); die();
        $this->load->view('admin',$data);
    }

    public function detail_contract()
    {   
        priv("view");
        $id = $this->input->get("contract_id");
        $schedule_id = $this->input->get("contract_schedule_id");
        $parent_schedule_id = $this->input->get("parent_schedule_id");

        $data["page"]      = "schedule/master/detail_contract";
        $data["title"]     = "Detail Service";
        $data['data']      = $this->global_model->get_data_join("*", "contract_schedule a", "where a.contract_id = '".$id."' and contract_schedule_id = '".$schedule_id."'", "left join contract as b on b.contract_id = a.contract_id")->result_array();
        $data['installer'] = $this->global_model->get_data_join("*", "contract_installer a", "where a.contract_id = '".$id."' and b.teknisi_type = '1'", "left join teknisi_master as b on b.teknisi_id = a.installer_id")->result_array();
        $data['teknisi']   = $this->global_model->get_data_join("*", "contract_teknisi a", "where a.contract_id = '".$id."' and b.teknisi_type = '2'", "left join teknisi_master as b on b.teknisi_id = a.teknisi_id")->result_array();
        $data['product'] = $this->global_model->get_data_join("*", "contract_schedule_detail a", "where a.contract_schedule_id = '".$parent_schedule_id."' and a.product_type = '2'", "left join product_master as b on b.product_id = a.product_id left join product_category as c on c.category_id = b.category_id")->result_array();
        $data['package'] = $this->global_model->get_data_join("*", "contract_schedule_detail a", "where a.contract_schedule_id = '".$parent_schedule_id."' and a.product_type = '1'", "left join product_package as b on b.package_id = a.package_id")->result_array();
        // echo "<pre>"; print_r($data['data']); die();
        $this->load->view('admin',$data);
    }

    public function detail_request()
    {
        priv('other');
        $data["page"]           = "schedule/master/detail_request";
        $data["title"]          = "Detail Request";
        $id                     = $this->input->get('package_id');
        $contract_id            = $this->input->get('contract_id');
        $schedule_id            = $this->input->get("contract_schedule_id");
        $data['schedule']       = $this->input->get('schedule_type');
        $data['contract']       = $this->global_model->get_data('*', 'contract', 'where contract_id = "'.$contract_id.'"')->result_array();
        $data['data']           = $this->global_model->get_data_join("*", "contract_schedule a", "where a.contract_id = '".$contract_id."' and contract_schedule_id = '".$schedule_id."'", "left join contract as b on b.contract_id = a.contract_id")->result_array();
        $data['package']        = $this->global_model->get_data_join('*','product_package_detail a', 'where a.package_id = "'.$id.'" and b.deleted = "0"', "left join product_master as b on b.product_id = a.product_id left join product_category as c on c.category_id = b.category_id")->result_array();
        // echo "<pre>"; print_r($data['data']); die();
        $this->load->view('admin',$data);

    }

    function edit($id) {
    priv("edit");   
        $data["page"]       = "schedule/master/edit";
        $data["title"]      = "Edit Assignment";
        $data['data']       = $this->global_model->get_data("*", "contract", "where contract_id = '".$id."'")->result_array();
        $data['installer']  =  $this->global_model->get_data("*", "teknisi_master", "where deleted = '0' And teknisi_type = '1'")->result_array();
        $data['teknisi']    =  $this->global_model->get_data("*", "teknisi_master", "where deleted = '0' And teknisi_type = '2'")->result_array();
        $data['product']    = $this->global_model->get_data_join("*", "contract_detail a", "where a.contract_id = '".$id."' and a.contract_type = '2' and a.deleted = '0'", "left join product_master as b on b.product_id = a.product_id left join product_category as c on c.category_id = b.category_id")->result_array();
        $data['package']    = $this->global_model->get_data_join("*", "contract_detail a", "where a.contract_id = '".$id."' and a.contract_type = '1' and a.deleted = '0'", "left join product_package as b on b.package_id = a.package_id")->result_array();
        $this->load->view('admin',$data);
        // print_r($data['package']); die();
        if ($this->input->post()) {
            $post = $this->input->post();
            // echo "<pre>"; print_r($post); die();
            // update contract
            $date   = date("Y-m-d", strtotime($post['install_date']));
            $input  = array(
                "install_date"      => $date,
                "working_day"       => $post["working_day"],
                "contract_note"     => $post["contract_note"],
                "assign_status"     => $post["assign_status"],
                "created_date"      => date("Y-m-d H:i:s"),
                "created_by"        => $this->session->userdata("admin_id")
            );
            $this->db->where("contract_id", $id);
            $this->db->update("contract", $input);

            // insert schedule install
            $date = date("Y-m-d", strtotime($post['install_date']));
            $schedule_install = array(
                "contract_id" => $id,
                "schedule_date" =>  $date,
                "created_date" => date("Y-m-d H:i:s"),
                "schedule_type" => "1",
                );
            $this->db->insert("contract_schedule", $schedule_install);
            $schedule_id = $this->db->insert_id();

            // insert schedule teknisi
            for ($i=0; $i<count($post['teknisi']); $i++) { 
                $schedule_teknisi['contract_schedule_id']       = $schedule_id;
                $schedule_teknisi['contract_id']                = $id;
                $schedule_teknisi['teknisi_id']                 = $post['teknisi'][$i];
                $schedule_teknisi['created_date']               = date("Y-m-d H:i:s");
                $schedule_teknisi['created_by']                 = $this->session->userdata("admin_id");

                $this->db->insert("contract_teknisi", $schedule_teknisi);
            }

            // insert schedule installer
            for ($i=0; $i<count($post['installer']); $i++) { 
                $jadwal['contract_id']          = $id;
                $jadwal['contract_schedule_id'] = $schedule_id;
                $jadwal['installer_id']         = $post['installer'][$i];
                $jadwal['created_date']         = date("Y-m-d H:i:s");
                $jadwal['created_by']           = $this->session->userdata("admin_id");

                $this->db->insert("contract_installer", $jadwal);
            }

            // insert schedule detail for product
            $product = $post['product_id'];
            if (!empty($product)) {
                for ($i=0; $i<count($product); $i++) { 
                    
                    $schedule_detail = array(
                        "contract_schedule_id"      => $schedule_id,
                        "product_type"              => '2',
                        "package_id"                => '0',
                        "product_id"                => $product[$i],
                        "product_qty"               => $post['product_qty'][$i],
                        "package_qty"               => '0',
                        "price"                     => $post['price'][$i],
                    );
                    $this->db->insert("contract_schedule_detail", $schedule_detail);
                }
            }

            // insert schedule detail for package
            $package = $post['package_id'];
            if (!empty($package)) {
                for ($i=0; $i<count($package); $i++) { 
                    
                    $schedule_detail = array(
                        "contract_schedule_id"      => $schedule_id,
                        "product_type"              => '1',
                        "package_id"                => $package[$i],
                        "product_id"                => '0',
                        "product_qty"               => '0',
                        "package_qty"               => $post['package_qty'][$i],
                        "price"                     => $post['package_price'][$i],
                    );
                    $this->db->insert("contract_schedule_detail", $schedule_detail);
                }
            }
            

            // insert schedule
            $contract_period    = $post['period'];
            $contract_id        = $id;
            $working_day        = $post['working_day'];
            $contract_date      = $post['contract_date'];
            $installer          = $post['installer'];
            $teknisi            = $post['teknisi'];
            
            $this->insert_schedule($contract_period, $contract_id, $working_day, $contract_date, $installer, $teknisi, $schedule_id);

            redirect("schedule_master");
        }
    }

    function insert_schedule($contract_period, $contract_id, $working_day, $contract_date, $installer, $teknisi, $schedule_id)
    {
        for($i=1;$i<=$contract_period-1;$i++) {
            $new_contract_date = strtotime($contract_date);
            $final_contract_date = date("Y-m-d",strtotime("+".$i." month",$new_contract_date));
            $final_contract_date1 = strtotime($final_contract_date);
            $month = date("m", $final_contract_date1);
            $year = date("Y", $final_contract_date1);

            $schedule_date = $this->get_schedule_date($month,$working_day,$year);
            $clearobj = json_decode(json_encode($schedule_date), true);
            $schedule_date0 = $clearobj;
            foreach ($schedule_date0 as $value) {
                $time = strtotime($value['calendar_date']);
                $newFormat = date("Y-m-d",$time);
            }
                $schedule = array(
                    "parent_schedule_id" => $schedule_id,
                    "contract_id" => $contract_id,
                    "year" =>  $year,
                    "month" => $month,
                    "schedule_date" => $newFormat,
                    "working_day" => $working_day,
                    "created_date" => date("Y-m-d H:i:s"),
                    "schedule_type" => "2",
                    );
                $this->db->insert("contract_schedule",$schedule);
                $contract_schedule_id = $this->db->insert_id();
        }

        $update['parent_schedule_id'] = $schedule_id;
        $this->db->where('contract_schedule_id', $schedule_id);
        $this->db->update('contract_schedule', $update);
    }


    function get_schedule_date($month,$working_day,$year){
        $this->db->select("calendar_date");
        $this->db->from("calendar");
        $this->db->where("deleted","0");
        if($month != "" && $working_day !=""){
            $this->db->where("calendar_month", $month);
            $this->db->where("working_day", $working_day);
            $this->db->where('calendar_year', $year);
        }
        $data = $this->db->get();
        return $data->result();
    }

    function _to_excel($all_data = array()) {
        $this->load->library('excel_exporter', null, 'excel');

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $objPHPExcel = new PHPExcel();

        $objPHPExcel->getProperties()->setCreator("Ecocare");
        $objPHPExcel->getProperties()->setLastModifiedBy("Ecocare");
        $objPHPExcel->getProperties()->setTitle("Ecocare MR/UR");
        // $start_date = $all_data["start_date"];
        // $end_date = $all_data["end_date"];
        // $periode = $all_data["periode"];
        // if($start_date !="" && $end_date !="") {
        //     $objPHPExcel->getProperties()->setSubject("Tokio Marine Attendance Periode : " . $start_date . " / " . $end_date);
        //     $objPHPExcel->getProperties()->setDescription("Tokio Marine Attendance Periode : " . $start_date . " / " . $end_date);
        // } elseif($start_date != "") {
        //     $objPHPExcel->getProperties()->setSubject("Tokio Marine Attendance Periode : " . $start_date);
        //     $objPHPExcel->getProperties()->setDescription("Tokio Marine Attendance Periode : " . $start_date);
        // } elseif($end_date != "") {
        //     $objPHPExcel->getProperties()->setSubject("Tokio Marine Attendance Periode : " . $end_date);
        //     $objPHPExcel->getProperties()->setDescription("Tokio Marine Attendance Periode : " . $end_date);
        // } elseif($periode) {
        //     $objPHPExcel->getProperties()->setSubject("Tokio Marine Attendance Periode : " . $periode);
        //     $objPHPExcel->getProperties()->setDescription("Tokio Marine Attendance Periode : " . $periode);
        // }

        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Ecocare MR/UR Staff');
        // if($start_date !="" && $end_date !="") {
        //     $objPHPExcel->getActiveSheet()->SetCellValue('A2', 'Periode : ' . $start_date . " / " . $end_date);
        // } elseif($start_date != "") {
        //     $objPHPExcel->getActiveSheet()->SetCellValue('A2', 'Periode : ' . $start_date);
        // } elseif($end_date != "") {
        //     $objPHPExcel->getActiveSheet()->SetCellValue('A2', 'Periode : ' . $end_date);
        // } elseif($periode) {
        //     $objPHPExcel->getActiveSheet()->SetCellValue('A2', 'Periode : ' . $periode);
        // }

        $objPHPExcel->getActiveSheet()->SetCellValue('A3', 'NO');
        $objPHPExcel->getActiveSheet()->SetCellValue('B3', 'TEKNISI NAME');
        $objPHPExcel->getActiveSheet()->SetCellValue('C3', 'CUSTOMER NAME');
        $objPHPExcel->getActiveSheet()->SetCellValue('D3', 'CONTRACT NO');
        $objPHPExcel->getActiveSheet()->SetCellValue('E3', 'CODE BARANG');
        $objPHPExcel->getActiveSheet()->SetCellValue('F3', 'NAMA BARANG');
        $objPHPExcel->getActiveSheet()->SetCellValue('G3', 'CATEGORY NAME');
        $objPHPExcel->getActiveSheet()->SetCellValue('H3', 'QUANTITY');


        $no = 1;
        $num = 4;
        foreach ($all_data['get_data_per_product_package'] as $key => $val):
            $row = $num++;

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $row, $no++);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $row, ucwords($val["staff_name"]));
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $row, ucwords($val["member_name"]));
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $row, $val["contract_no"]);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $row, $val["code_barang"]);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $row, $val["nama_barang"]);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $row, $val["category_name"]);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $row, $val["amount"]);
        endforeach;
        // print_r($all_data['get_data_per_product_package']);
        

        $objPHPExcel->getActiveSheet()->setTitle("Ecocare - Staff MR UR");

        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=Ecocare-MR-UR.xls");  //File name extension was wrong
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;
    }
   
}