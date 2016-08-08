<?php
use Fuel\Core\Debug;
use Fuel\Core\DB;
use Fuel\Core\Pagination;
$offset_num = 0;
if (isset($_GET["p"]))
{
	$offset_num = ($_GET["p"]-1)*10;
}
$query = DB::select()->from('kadai_hasegawa_fuel_res_bbs')->limit($show_num)->offset($offset_num);
$viewdata = $query->execute();
$data_num = 1;

?>
<!DOCTYPE html>
<html>
<head>
<title>fuelPHP課題1</title>
</head>
<script>
</script>
<body>
	<p>fuelPHP課題1</p>
	<?php
	echo Pagination::create_links();
	?>
	<p>======================================</p>
	<?php
	if (isset($viewdata[0]))
	{
		foreach ($viewdata as $row)
		{
			echo $row["id"].", ";
			echo $row["user_name"];
			echo " (投稿日時: ".$row["res_time"]." )<br>";
			$show_content = str_replace("\n","<br>",$row["content"]);
			echo $show_content."<br>";
			$data_num++;
			if ($data_num <= count($viewdata))
			{
				echo "<br>--------------------------------------<br>";
			}
		}
	}
	else
	{
		echo "<p>投稿内容がありません<br></p>";
	}
	?>
	<p>======================================</p>
	<?php echo Form::open(array('action' => '', 'method' => 'post')); ?>
	<p><label for="form_name" class="col-sm-4 control-label">名前</label><br>
	<?php echo Form::input('name',Session::get_flash('name'),array('class' => 'form-control'));?></p>
	<p><label for="" class="col-sm-4 control-label">Email</label><br>
	<?php echo Form::input('email',Session::get_flash('email'),array('class' => 'form-control','placeholder' => 'mail@example.com'));?></p>
	<p><label for="" class="col-sm-4 control-label">内容</label><br>
	<?php echo Form::textarea('msg',Session::get_flash('msg'),array('rows'=>'6','class' => 'form-control'));?></p>
	<p><?php echo Form::submit('', '内容確認', array('class' => 'btn btn-success'));?></p>
	<?php echo Form::close();?>
</body>
</html>