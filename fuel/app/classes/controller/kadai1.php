<?php
use Fuel\Core\Debug;
class Controller_Kadai1 extends Controller
{
	public function action_index()
	{
		$res_num =count(DB::select()->from('kadai_hasegawa_fuel_res_bbs')->execute());
		$show_num = 10;
		//設定
		$config = array(
				'pagination_url' => '',
				'uri_segment' => 'p',
				'num_links' => 9,
				'per_page' => $show_num,
				'total_items' => $res_num,
				'name' => 'pagination',
				'show_first' => true,
				'show_last' => true,
		);
		Pagination::set_config($config);
		//データ取得
		$data = DB::select()->from('kadai_hasegawa_fuel_res_bbs')->limit(Pagination::get('per_page'))
		->offset(Pagination::get('offset'))
		->execute()
		->as_array();
		//バリデーション
		$post_data_check = false;
		$validation = Validation::forge();
		if (Input::method() == 'POST')
		{
			$validation->add('name','名前');
			$validation->add('email','メールアドレス')
			->add_rule('valid_email');
			$validation->add('msg','投稿内容');
			if($validation->run())
			{
				$post_data_check = true;
			}
			else
			{
				$post_data_check = false;
			}
		}
		//DBに書き込み追加
		if (isset($_POST["msg"]))
		{
			$add_res_id = $res_num+1;
			$res_time = Date::time('Asia/Tokyo')->format('%Y/%m/%d %H:%M:%S');
			$add_name = htmlspecialchars($_POST["name"]);
			$add_email = $_POST["email"];
			if ($add_name == "")
			{
				$add_name = "匿名希望";
			}
			$add_content = htmlspecialchars($_POST["msg"]);
			if($post_data_check)
			{
				$add_record = DB::insert('kadai_hasegawa_fuel_res_bbs')->set(array(
						'id' => $add_res_id,
						'res_time' => $res_time,
						'user_name' => $add_name,
						'content' => $add_content,
						'mail_address' => $add_email,
				))->execute();
				header("Location: ./kadai1");
				exit();
			}
			else
			{
				die("書き込みに失敗しました");
			}
		}

		$data = array();
		$data["res_num"] = $res_num;
		$data["show_num"] = $show_num;
		//view表示
		$view = View::forge('kadai1/kadai1',$data);
		return $view;
	}
}