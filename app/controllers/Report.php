<?php

class Report extends Controller {
	public function __construct() {
		if ( !isset($_SESSION['is_login']) ) {
			header('Location: ' . BASEURL . '/user/login');
		}
	}

	public function index() {
		$data['judul'] = 'Laporan Harian';
		$data['totalnotifications'] = $this->model('Item_model')->getStockNotification()['TOTAL_NOTIFICATIONS'];
		$data['notifications'] = $this->model('Item_model')->getTotalStockItem();
		$data['periode'] = isset($_POST['bulan']) ? $_POST['bulan'] : date('Y-m');

		$data['dailyReport'] = $this->model('Report_model')->getReportHarian(date('Y-m-d'));
		// Debug output
		// var_dump($data['dailyReport']);
		// exit;
		if($this->model('User_model')->checkRowToko() > 0) {
			$this->view('templates/s-header', $data);
			$this->view('report/index', $data);
		}
		else {
			header('Location: ' . BASEURL . '/dashboard/toko');
		}    

	}

	public function bulan() {
		$data['judul'] = 'Laporan Bulanan';
		$data['totalnotifications'] = $this->model('Item_model')->getStockNotification()['TOTAL_NOTIFICATIONS'];
		$data['notifications'] = $this->model('Item_model')->getTotalStockItem();
		$data['periode'] = isset($_POST['bulan']) ? $_POST['bulan'] : date('Y-m');

		$data['bulan'] = $this->model('Report_model')->getAvailableMonths();
		$data['monthlyChartData'] = $this->model('Report_model')->getDailyPerMonths(date('m'));
		$data['totalBulanan'] = $this->model('Report_model')->getTotalMonth(date('m'));
		// Debug output
		// var_dump($data['monthlyChartData']);  
		// exit;
		$chartData = json_encode($data['monthlyChartData']);
		
		if($this->model('User_model')->checkRowToko() > 0) {
			$this->view('templates/s-header', $data);
			$this->view('report/bulan', $data);
		}
		else {
			header('Location: ' . BASEURL . '/dashboard/toko');
		}    
	}

	public function tahun() {
		$data['judul'] = 'Laporan Tahunan';
		$data['totalnotifications'] = $this->model('Item_model')->getStockNotification()['TOTAL_NOTIFICATIONS'];
		$data['notifications'] = $this->model('Item_model')->getTotalStockItem();
		

		$data['tahun'] = $this->model('Report_model')->getAvailableYears();
		$data['annualReport'] = $this->model('Report_model')->getMonthlyPerYears(date('Y'));
		$data['totalTahunan'] = $this->model('Report_model')->getTotalYear(date('Y'));
		// Debug output
		// var_dump($data['totalTahunan']);
		// exit;

		if($this->model('User_model')->checkRowToko() > 0) {
			$this->view('templates/s-header', $data);
			$this->view('report/tahun', $data);
		}
		else {
			header('Location: ' . BASEURL . '/dashboard/toko');
		}    
	}

	public function getDailyReport() {
		// var_dump(($_POST['dateHarian']));
		// exit;
		$data['judul'] = 'Laporan Harian';
		$data['totalnotifications'] = $this->model('Item_model')->getStockNotification()['TOTAL_NOTIFICATIONS'];
		$data['notifications'] = $this->model('Item_model')->getTotalStockItem();

		$dateHarian = ($_POST['dateHarian']) ? $_POST['dateHarian'] : date('Y-m-d');
		$data['dailyReport'] = $this->model('Report_model')->getReportHarian($dateHarian);
		$data['judul'] = 'Laporan Harian';
		
		// var_dump($data['dailyReport']);
		// exit;

		$this->view('templates/s-header', $data);
    $this->view('report/index', $data);
	}

	public function getMonthlyReport() { 
		if (isset($_POST['bulan'])) {
			$bulan = $_POST['bulan'];  // format: YYYY-MM
			$bulanOnly = substr($bulan, 5, 2);  // Mengambil hanya bagian bulan (2 digit)
			echo $bulanOnly;  // Menampilkan bulan dalam format "MM"
		}	
		$bulan = ($_POST['bulan']) ? $bulanOnly : date('Y-m');
		$data['judul'] = 'Laporan Bulanan';
		$data['totalnotifications'] = $this->model('Item_model')->getStockNotification()['TOTAL_NOTIFICATIONS'];
		$data['notifications'] = $this->model('Item_model')->getTotalStockItem();
		$data['bulan'] = $this->model('Report_model')->getAvailableMonths();
	
		$data['monthlyChartData'] = $this->model('Report_model')->getDailyPerMonths($bulan);
		$data['totalBulanan'] = $this->model('Report_model')->getTotalMonth($bulan);
		
		$this->view('templates/s-header', $data);
		$this->view('report/bulan', $data);
	}
	

	public function getAnnualReport() {
		$data['judul'] = 'Laporan Tahunan';
		$data['totalnotifications'] = $this->model('Item_model')->getStockNotification()['TOTAL_NOTIFICATIONS'];
		$data['notifications'] = $this->model('Item_model')->getTotalStockItem();
		$data['tahun'] = $this->model('Report_model')->getAvailableYears();

		$year = ($_POST['dateTahun']) ? $_POST['dateTahun'] : date('Y');
		$data['annualReport'] = $this->model('Report_model')->getMonthlyPerYears($year);
		$data['totalTahunan'] =	$this->model('Report_model')->getTotalYear($year);

		// var_dump($data['annualReport']);
		// exit;

		$labels = [];
    $pemasukanData = [];
    $pengeluaranData = [];

    // Loop untuk mengambil data per bulan dan memasukkannya ke dalam array
    foreach ($data['annualReport'] as $report) {
			// Menambahkan nama bulan ke labels
			$labels[] = $report['NAMA_BULAN'];

			// Menambahkan pemasukan dan pengeluaran per bulan ke data
			$pemasukanData[] = (float) $report['TOTAL_PENDAPATAN'];
			$pengeluaranData[] = (float) $report['TOTAL_PENGELUARAN'];
    }

    // Menyiapkan data untuk Chart.js
    $data['chartData'] = [
			'labels' => $labels,
			'pemasukan' => $pemasukanData,
			'pengeluaran' => $pengeluaranData
    ];
		
		$this->view('templates/s-header', $data);
		$this->view('report/tahun', $data);
	}
	

	
}
