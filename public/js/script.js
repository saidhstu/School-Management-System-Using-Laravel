$(document).ready(function(){
	$(window).scroll(function(){
		var scrolValue = $(window).scrollTop();
		if(scrolValue > 155) {
			$('#fixed-header').slideDown(400);
		} else{
			$('#fixed-header').slideUp(400);
		}
	});

	$("#up").on('click',function(e){
		e.preventDefault();
		$('html,body').animate({
			'scrollTop':'0'
		},500);
	});
});

$('.auto-select').select2();
$('.multi').multiselect();





$("#latest-news > span").css("color","white");
$(document).on("click","#checkAll",function(){
	$('.state').prop("checked",'true');
});

$(document).on("click","#uncheckAll",function(){
	$('.state').removeAttr("checked",'false');
});

$(".give_date").on('change',function() {
	$(".take_date").val($(this).val());
});


$(document).on('change','.s_s',function() {
	var sem,val;
	val = $(this).val();
	sem = $(this).closest('tr.s_f_r').find('.s_v').attr('name','sem_fee['+val+']');
});

$(document).on('change','.s_m',function() {
	var sem,val;
	val = $(this).val();
	sem = $(this).closest('tr.s_f_m').find('.s_m_v').attr('name','mid_fee['+val+']');
});

$(document).on('change','.s_f_c',function() {
	var sem,val;
	val = $(this).val();
	sem = $(this).closest('tr.s_f_f').find('.s_f_cv').attr('name','form_fee['+val+']');
});

$(document).on('change','.m_s',function() {
	var sem,val,exam;
	val = $(this).val();
	sem = $(this).closest('tr.m_f').find('.m_o_s').attr('name','model_fee['+val+']');
	exam = $(this).closest('tr.m_f').find('.exam_mod').attr('name','sem_exam['+val+']');
});

$(document).on('change','.l_f_c',function() {
	var sem,val;
	val = $(this).val();
	sem = $(this).closest('tr.l_f').find('.l_f_cv').attr('name','late_fee['+val+']');
});

$(document).on('change','.sup_l_c',function() {
	var sem,val;
	val = $(this).val();
	sem = $(this).closest('tr.sup_f').find('.sup_f_cv').attr('name','sup_fee['+val+']');
});

$(document).on('change','.stu_l_c',function() {
	var sem,val;
	val = $(this).val();
	sem = $(this).closest('tr.stu_f').find('.stu_f_cv').attr('name','stu_fee['+val+']');
});

$(document).on('change','.sup_lf_c',function() {
	var sem,val;
	val = $(this).val();
	//alert(val);
	sem = $(this).closest('tr.sup_lf').find('.sup_lf_cv').attr('name','sup_late_fee['+val+']');
});

var i = 1;
$('#add').on('click',function () {
	i++;
	$('#dynamic-field').append('' +
			'<tr id="row_beton'+i+'">' +
				'<td>' +
					'<select class="form-control" name="beton_class[]">' +
						'<option value="">Class</option>' +
						'<option value="1">Class One</option>' +
						'<option value="2">Class Two</option>' +
						'<option value="3">Class Three</option>' +
						'<option value="4">Class Four</option>' +
						'<option value="5">Class Five</option>' +
						'<option value="6">Class Six</option>' +
						'<option value="7">Class Seven</option>' +
						'<option value="8">Class Eight</option>' +
						'<option value="9">Class Nine</option>' +
						'<option value="10">Class Ten</option>' +
						'<option value="11">Class Eleven</option>' +
						'<option value="12">Class Tweleve</option>' +
					'</select>' +
				'</td>' +
				'<td>' +
					'<select class="form-control" name="beton_month[]">' +
						'<option value="">Month</option>' +
						'<option value="1">January</option>' +
						'<option value="2">February</option>' +
						'<option value="3">March</option>' +
						'<option value="4">April</option>' +
						'<option value="5">May</option>' +
						'<option value="6">June</option>' +
						'<option value="7">July</option>' +
						'<option value="8">August</option>' +
						'<option value="9">September</option>' +
						'<option value="10">October</option>' +
						'<option value="11">November</option>' +
						'<option value="12">December</option>' +
					'</select>' +
				'</td>' +
				'<td>' +
					'<select class="form-control" name="beton_session[]">' +
						'<option value="">Session</option>' +
						'<option value="2018">2018</option>' +
						'<option value="2019">2019</option>' +
						'<option value="2020">2020</option>' +
						'<option value="2021">2021</option>' +
						'<option value="2022">2022</option>' +
						'<option value="2023">2023</option>' +
						'<option value="2024">2024</option>' +
						'<option value="2025">2025</option>' +
						'<option value="2026">2026</option>' +
						'<option value="2027">2027</option>' +
						'<option value="2028">2028</option>' +
						'<option value="2029">2029</option>' +
						'<option value="2030">2030</option>' +
					'</select>' +
				'</td>' +
				'<td>' +
					'<input type="text" name="beton_amount[]" id="name" class="form-control" placeholder="Enter Amount">' +
				'</td>' +
				'<td>' +
					'<button type="button"td class="btn btn-danger btn_remove" name="remove" id="'+i+'"><span class="glyphicon glyphicon-remove"></span></button>' +
				'</td>' +
			'</tr>'
	);
});

$(document).on('click','.btn_remove',function () {
	var button_id = $(this).attr("id");
	$('#row_beton'+button_id+'').remove();
});

var i = 1;
$('#add10').on('click',function () {
	i++;
	$('#dynamic-field10').append('' +
			'<tr id="row_tifin'+i+'">' +
			'<td>' +
			'<select class="form-control" name="tifin_class[]">' +
			'<option value="">Class</option>' +
			'<option value="1">Class One</option>' +
			'<option value="2">Class Two</option>' +
			'<option value="3">Class Three</option>' +
			'<option value="4">Class Four</option>' +
			'<option value="5">Class Five</option>' +
			'<option value="6">Class Six</option>' +
			'<option value="7">Class Seven</option>' +
			'<option value="8">Class Eight</option>' +
			'<option value="9">Class Nine</option>' +
			'<option value="10">Class Ten</option>' +
			'<option value="11">Class Eleven</option>' +
			'<option value="12">Class Tweleve</option>' +
			'</select>' +
			'</td>' +
			'<td>' +
			'<select class="form-control" name="tifin_month[]">' +
			'<option value="">Month</option>' +
			'<option value="1">January</option>' +
			'<option value="2">February</option>' +
			'<option value="3">March</option>' +
			'<option value="4">April</option>' +
			'<option value="5">May</option>' +
			'<option value="6">June</option>' +
			'<option value="7">July</option>' +
			'<option value="8">August</option>' +
			'<option value="9">September</option>' +
			'<option value="10">October</option>' +
			'<option value="11">November</option>' +
			'<option value="12">December</option>' +
			'</select>' +
			'</td>' +
			'<td>' +
			'<select class="form-control" name="tifin_session[]">' +
			'<option value="">Session</option>' +
			'<option value="2018">2018</option>' +
			'<option value="2019">2019</option>' +
			'<option value="2020">2020</option>' +
			'<option value="2021">2021</option>' +
			'<option value="2022">2022</option>' +
			'<option value="2023">2023</option>' +
			'<option value="2024">2024</option>' +
			'<option value="2025">2025</option>' +
			'<option value="2026">2026</option>' +
			'<option value="2027">2027</option>' +
			'<option value="2028">2028</option>' +
			'<option value="2029">2029</option>' +
			'<option value="2030">2030</option>' +
			'</select>' +
			'</td>' +
			'<td>' +
			'<input type="text" name="tifin_amount[]" id="name" class="form-control" placeholder="Enter Amount">' +
			'</td>' +
			'<td>' +
			'<button type="button" class="btn btn-danger btn_remove10" name="remove" id="'+i+'"><span class="glyphicon glyphicon-remove"></span></button>' +
			'</td>' +
			'</tr>'
	);
});

$(document).on('click','.btn_remove10',function () {
	var button_id = $(this).attr("id");
	$('#row_tifin'+button_id+'').remove();
});

var i = 1;
$('#add11').on('click',function () {
	i++;
	$('#dynamic-field11').append('' +
			'<tr id="row_elec'+i+'">' +
			'<td>' +
			'<select class="form-control" name="elec_class[]">' +
			'<option value="">Class</option>' +
			'<option value="1">Class One</option>' +
			'<option value="2">Class Two</option>' +
			'<option value="3">Class Three</option>' +
			'<option value="4">Class Four</option>' +
			'<option value="5">Class Five</option>' +
			'<option value="6">Class Six</option>' +
			'<option value="7">Class Seven</option>' +
			'<option value="8">Class Eight</option>' +
			'<option value="9">Class Nine</option>' +
			'<option value="10">Class Ten</option>' +
			'<option value="11">Class Eleven</option>' +
			'<option value="12">Class Tweleve</option>' +
			'</select>' +
			'</td>' +
			'<td>' +
			'<select class="form-control" name="elec_month[]">' +
			'<option value="">Month</option>' +
			'<option value="1">January</option>' +
			'<option value="2">February</option>' +
			'<option value="3">March</option>' +
			'<option value="4">April</option>' +
			'<option value="5">May</option>' +
			'<option value="6">June</option>' +
			'<option value="7">July</option>' +
			'<option value="8">August</option>' +
			'<option value="9">September</option>' +
			'<option value="10">October</option>' +
			'<option value="11">November</option>' +
			'<option value="12">December</option>' +
			'</select>' +
			'</td>' +
			'<td>' +
			'<select class="form-control" name="elec_session[]">' +
			'<option value="">Session</option>' +
			'<option value="2018">2018</option>' +
			'<option value="2019">2019</option>' +
			'<option value="2020">2020</option>' +
			'<option value="2021">2021</option>' +
			'<option value="2022">2022</option>' +
			'<option value="2023">2023</option>' +
			'<option value="2024">2024</option>' +
			'<option value="2025">2025</option>' +
			'<option value="2026">2026</option>' +
			'<option value="2027">2027</option>' +
			'<option value="2028">2028</option>' +
			'<option value="2029">2029</option>' +
			'<option value="2030">2030</option>' +
			'</select>' +
			'</td>' +
			'<td>' +
			'<input type="text" name="elec_amount[]" id="name" class="form-control" placeholder="Enter Amount">' +
			'</td>' +
			'<td>' +
			'<button type="button" class="btn btn-danger btn_remove11" name="remove" id="'+i+'"><span class="glyphicon glyphicon-remove"></span></button>' +
			'</td>' +
			'</tr>'
	);
});

$(document).on('click','.btn_remove11',function () {
	var button_id = $(this).attr("id");
	$('#row_elec'+button_id+'').remove();
});

var i = 1;
$('#add12').on('click',function () {
	i++;
	$('#dynamic-field12').append('' +
			'<tr id="row_session'+i+'">' +
			'<td>' +
			'<select class="form-control" name="session_class[]">' +
			'<option value="">Class</option>' +
			'<option value="1">Class One</option>' +
			'<option value="2">Class Two</option>' +
			'<option value="3">Class Three</option>' +
			'<option value="4">Class Four</option>' +
			'<option value="5">Class Five</option>' +
			'<option value="6">Class Six</option>' +
			'<option value="7">Class Seven</option>' +
			'<option value="8">Class Eight</option>' +
			'<option value="9">Class Nine</option>' +
			'<option value="10">Class Ten</option>' +
			'<option value="11">Class Eleven</option>' +
			'<option value="12">Class Tweleve</option>' +
			'</select>' +
			'</td>' +
			'<td>' +
			'<select class="form-control" name="session_session[]">' +
			'<option value="">Session</option>' +
			'<option value="2018">2018</option>' +
			'<option value="2019">2019</option>' +
			'<option value="2020">2020</option>' +
			'<option value="2021">2021</option>' +
			'<option value="2022">2022</option>' +
			'<option value="2023">2023</option>' +
			'<option value="2024">2024</option>' +
			'<option value="2025">2025</option>' +
			'<option value="2026">2026</option>' +
			'<option value="2027">2027</option>' +
			'<option value="2028">2028</option>' +
			'<option value="2029">2029</option>' +
			'<option value="2030">2030</option>' +
			'</select>' +
			'</td>' +
			'<td>' +
			'<input type="text" name="session_amount[]" id="name" class="form-control" placeholder="Enter Amount">' +
			'</td>' +
			'<td>' +
			'<button type="button" class="btn btn-danger btn_remove12" name="remove" id="'+i+'"><span class="glyphicon glyphicon-remove"></span></button>' +
			'</td>' +
			'</tr>'
	);
});

$(document).on('click','.btn_remove12',function () {
	var button_id = $(this).attr("id");
	$('#row_session'+button_id+'').remove();
});


var i = 1;
$('#add4').on('click',function () {
	i++;
	$('#dynamic-field4').append('' +
			'<tr id="row_fine'+i+'">' +
			'<td>' +
			'<select class="form-control" name="fine_class[]">' +
			'<option value="">Class</option>' +
			'<option value="1">Class One</option>' +
			'<option value="2">Class Two</option>' +
			'<option value="3">Class Three</option>' +
			'<option value="4">Class Four</option>' +
			'<option value="5">Class Five</option>' +
			'<option value="6">Class Six</option>' +
			'<option value="7">Class Seven</option>' +
			'<option value="8">Class Eight</option>' +
			'<option value="9">Class Nine</option>' +
			'<option value="10">Class Ten</option>' +
			'<option value="11">Class Eleven</option>' +
			'<option value="12">Class Tweleve</option>' +
			'</select>' +
			'</td>' +
			'<td>' +
			'<select class="form-control" name="fine_month[]">' +
			'<option value="">Month</option>' +
			'<option value="1">January</option>' +
			'<option value="2">February</option>' +
			'<option value="3">March</option>' +
			'<option value="4">April</option>' +
			'<option value="5">May</option>' +
			'<option value="6">June</option>' +
			'<option value="7">July</option>' +
			'<option value="8">August</option>' +
			'<option value="9">September</option>' +
			'<option value="10">October</option>' +
			'<option value="11">November</option>' +
			'<option value="12">December</option>' +
			'</select>' +
			'</td>' +
			'<td>' +
			'<select class="form-control" name="fine_session[]">' +
			'<option value="">Session</option>' +
			'<option value="2018">2018</option>' +
			'<option value="2019">2019</option>' +
			'<option value="2020">2020</option>' +
			'<option value="2021">2021</option>' +
			'<option value="2022">2022</option>' +
			'<option value="2023">2023</option>' +
			'<option value="2024">2024</option>' +
			'<option value="2025">2025</option>' +
			'<option value="2026">2026</option>' +
			'<option value="2027">2027</option>' +
			'<option value="2028">2028</option>' +
			'<option value="2029">2029</option>' +
			'<option value="2030">2030</option>' +
			'</select>' +
			'</td>' +
			'<td>' +
			'<input type="text" name="fine_amount[]" id="name" class="form-control" placeholder="Enter Amount">' +
			'</td>' +
			'<td>' +
			'<button type="button"td class="btn btn-danger btn_remove_fine" name="remove" id="'+i+'"><span class="glyphicon glyphicon-remove"></span></button>' +
			'</td>' +
			'</tr>'
	);
});

$(document).on('click','.btn_remove_fine',function () {
	var button_id = $(this).attr("id");
	$('#row_fine'+button_id+'').remove();
});

var i = 1;
$('#add1').on('click',function () {
	i++;
	$('#dynamic-field1').append('' +
			'<tr id="row_other'+i+'">' +
			'<td>' +
			'<select class="form-control" name="other_class[]">' +
				'<option value="1">Class One</option>' +
				'<option value="2">Class Two</option>' +
				'<option value="3">Class Three</option>' +
				'<option value="4">Class Four</option>' +
				'<option value="5">Class Five</option>' +
				'<option value="6">Class Six</option>' +
				'<option value="7">Class Seven</option>' +
				'<option value="8">Class Eight</option>' +
				'<option value="9">Class Nine</option>' +
				'<option value="10">Class Ten</option>' +
				'<option value="11">Class Eleven</option>' +
				'<option value="12">Class Tweleve</option>' +
			'</select>' +
			'</td>' +
			'<td>' +
			'<select class="form-control" name="other_fund[]">' +
			'<option value="">Select Fund</option>' +
			'<option value="1">Admission Form Fee</option>' +
			'<option value="2">Admission Fee</option>' +
			'<option value="3">Board Re Admission Fee</option>' +
			'<option value="4">Board Registration Fee</option>' +
			'<option value="5">Library Fee</option>' +
			'<option value="6">Student ID Card Fee</option>' +
			'<option value="7">Testimonial Fee</option>' +
			'</select>' +
			'</td>' +
			'<td>' +
			'<select class="form-control" name="other_session[]">' +
			'<option value="">Session</option>' +
			'<option value="2018">2018</option>' +
			'<option value="2019">2019</option>' +
			'<option value="2020">2020</option>' +
			'<option value="2021">2021</option>' +
			'<option value="2022">2022</option>' +
			'<option value="2023">2023</option>' +
			'<option value="2024">2024</option>' +
			'<option value="2025">2025</option>' +
			'<option value="2026">2026</option>' +
			'<option value="2027">2027</option>' +
			'<option value="2028">2028</option>' +
			'<option value="2029">2029</option>' +
			'<option value="2030">2030</option>' +
			'</select>' +
			'</td>' +
			'<td>' +
			'<input type="text" name="other_amount[]" id="name" class="form-control" placeholder="Enter Amount">' +
			'</td>' +
			'<td>' +
			'<button type="button"td class="btn btn-danger btn_remove1" name="remove" id="'+i+'"><span class="glyphicon glyphicon-remove"></span></button>' +
			'</td>' +
			'</tr>'
	);
});

$(document).on('click','.btn_remove1',function () {
	var button_id = $(this).attr("id");
	$('#row_other'+button_id+'').remove();
});



var i = 1;

$('#add_fee').on('click',function () {
	i++;
	$('#fee_setting').append(
			'<tr id="row_other_fee'+i+'" class="other_fees">' +
			'<td>' +
			'<select class="form-control" name="fund_ids[]">' +
			'<option value="">Select Fund</option>' +
			'<option value="1">Admission Form Fee</option>' +
			'<option value="2">Admission Fee</option>' +
			'<option value="3">Board Re Admission Fee</option>' +
			'<option value="4">Board Registration Fee</option>' +
			'<option value="5">Library Fee</option>' +
			'<option value="6">Student ID Card Fee</option>' +
			'<option value="7">Testimonial Fee</option>' +
			'</select>' +
			'</td>' +
			'<td>' +
			'<input type="text" name="fund_amounts[]" id="name" class="form-control" placeholder="Enter Amount">' +
			'</td>' +
			'<td>' +
			'<input type="text" name="discount_amounts[]" id="name" class="form-control" placeholder="Discount">' +
			'</td>' +
			'<td>' +
			'<button type="button" class="btn btn-danger remove_fee" id="'+i+'"><span class="glyphicon glyphicon-remove"></span></button>' +
			'</td>' +
			'</tr>');
});

$(document).on('click','.remove_fee',function () {
	var button_id = $(this).attr("id");
	$('#row_other_fee'+button_id+'').remove();
});

var i = 1;
$('#add2').on('click',function () {
	i++;
	$('#dynamic-field2').append('' +
			'<tr id="row_exam'+i+'">' +
			'<td>' +
			'<select class="form-control" name="exam_class[]">' +
			'<option value="1">Class One</option>' +
			'<option value="2">Class Two</option>' +
			'<option value="3">Class Three</option>' +
			'<option value="4">Class Four</option>' +
			'<option value="5">Class Five</option>' +
			'<option value="6">Class Six</option>' +
			'<option value="7">Class Seven</option>' +
			'<option value="8">Class Eight</option>' +
			'<option value="9">Class Nine</option>' +
			'<option value="10">Class Ten</option>' +
			'<option value="11">Class Eleven</option>' +
			'<option value="12">Class Tweleve</option>' +
			'</select>' +
			'</td>' +
			'<td>' +
			'<select class="form-control" name="exam_id[]">' +
			'<option value="">Exam</option>' +
			'<option value="1">First Monthly</option>' +
			'<option value="2">Second Monthly</option>' +
			'<option value="3">Halfyearly</option>' +
			'<option value="4">Final</option>' +
			'</select>' +
			'</td>' +
			'<td>' +
			'<select class="form-control" name="exam_session[]">' +
			'<option value="">Session</option>' +
			'<option value="2018">2018</option>' +
			'<option value="2019">2019</option>' +
			'<option value="2020">2020</option>' +
			'<option value="2021">2021</option>' +
			'<option value="2022">2022</option>' +
			'<option value="2023">2023</option>' +
			'<option value="2024">2024</option>' +
			'<option value="2025">2025</option>' +
			'<option value="2026">2026</option>' +
			'<option value="2027">2027</option>' +
			'<option value="2028">2028</option>' +
			'<option value="2029">2029</option>' +
			'<option value="2030">2030</option>' +
			'</select>' +
			'</td>' +
			'<td>' +
			'<input type="text" name="exam_amount[]" id="name" class="form-control" placeholder="Enter Amount">' +
			'</td>' +
			'<td>' +
			'<button type="button"td class="btn btn-danger btn_remove2" name="remove" id="'+i+'"><span class="glyphicon glyphicon-remove"></span></button>' +
			'</td>' +
			'</tr>'
	);
});

var i = 1;
$('#add3').on('click',function () {
	i++;
	$('#dynamic-field3').append('' +
			'<tr id="row_form'+i+'">' +
			'<td>' +
			'<select class="form-control" name="form_class[]">' +
			'<option value="1">Class One</option>' +
			'<option value="2">Class Two</option>' +
			'<option value="3">Class Three</option>' +
			'<option value="4">Class Four</option>' +
			'<option value="5">Class Five</option>' +
			'<option value="6">Class Six</option>' +
			'<option value="7">Class Seven</option>' +
			'<option value="8">Class Eight</option>' +
			'<option value="9">Class Nine</option>' +
			'<option value="10">Class Ten</option>' +
			'<option value="11">Class Eleven</option>' +
			'<option value="12">Class Tweleve</option>' +
			'</select>' +
			'</td>' +
			'<td>' +
			'<select class="form-control" name="form_exam_id[]">' +
			'<option value="">Exam</option>' +
			'<option value="1">First Monthly</option>' +
			'<option value="2">Second Monthly</option>' +
			'<option value="3">Halfyearly</option>' +
			'<option value="4">Final</option>' +
			'</select>' +
			'</td>' +
			'<td>' +
			'<select class="form-control" name="form_session[]">' +
			'<option value="">Session</option>' +
			'<option value="2018">2018</option>' +
			'<option value="2019">2019</option>' +
			'<option value="2020">2020</option>' +
			'<option value="2021">2021</option>' +
			'<option value="2022">2022</option>' +
			'<option value="2023">2023</option>' +
			'<option value="2024">2024</option>' +
			'<option value="2025">2025</option>' +
			'<option value="2026">2026</option>' +
			'<option value="2027">2027</option>' +
			'<option value="2028">2028</option>' +
			'<option value="2029">2029</option>' +
			'<option value="2030">2030</option>' +
			'</select>' +
			'</td>' +
			'<td>' +
			'<input type="text" name="form_amount[]" id="name" class="form-control" placeholder="Enter Amount">' +
			'</td>' +
			'<td>' +
			'<button type="button"td class="btn btn-danger btn_remove3" name="remove" id="'+i+'"><span class="glyphicon glyphicon-remove"></span></button>' +
			'</td>' +
			'</tr>'
	);
});

var i = 1;
$('#add5').on('click',function () {
	i++;
	$('#dynamic-field5').append('' +
			'<tr id="row_attendence'+i+'">' +
			'<td>' +
			'<select class="form-control" name="attendence_class[]">' +
			'<option value="1">Class One</option>' +
			'<option value="2">Class Two</option>' +
			'<option value="3">Class Three</option>' +
			'<option value="4">Class Four</option>' +
			'<option value="5">Class Five</option>' +
			'<option value="6">Class Six</option>' +
			'<option value="7">Class Seven</option>' +
			'<option value="8">Class Eight</option>' +
			'<option value="9">Class Nine</option>' +
			'<option value="10">Class Ten</option>' +
			'<option value="11">Class Eleven</option>' +
			'<option value="12">Class Tweleve</option>' +
			'</select>' +
			'</td>' +
			'<td>' +
			'<select class="form-control" name="attendence_month[]">' +
			'<option value="">Month</option>' +
			'<option value="1">January</option>' +
			'<option value="2">February</option>' +
			'<option value="3">March</option>' +
			'<option value="4">April</option>' +
			'<option value="5">May</option>' +
			'<option value="6">June</option>' +
			'<option value="7">July</option>' +
			'<option value="8">August</option>' +
			'<option value="9">September</option>' +
			'<option value="10">October</option>' +
			'<option value="11">November</option>' +
			'<option value="12">December</option>' +
			'</select>' +
			'</td>' +
			'<td>' +
			'<select class="form-control" name="attendence_session[]">' +
			'<option value="">Session</option>' +
			'<option value="2018">2018</option>' +
			'<option value="2019">2019</option>' +
			'<option value="2020">2020</option>' +
			'<option value="2021">2021</option>' +
			'<option value="2022">2022</option>' +
			'<option value="2023">2023</option>' +
			'<option value="2024">2024</option>' +
			'<option value="2025">2025</option>' +
			'<option value="2026">2026</option>' +
			'<option value="2027">2027</option>' +
			'<option value="2028">2028</option>' +
			'<option value="2029">2029</option>' +
			'<option value="2030">2030</option>' +
			'</select>' +
			'</td>' +
			'<td>' +
			'<input type="text" name="attendence_amount[]" id="name" class="form-control" placeholder="Enter Amount">' +
			'</td>' +
			'<td>' +
			'<button type="button"td class="btn btn-danger btn_remove5" name="remove" id="'+i+'"><span class="glyphicon glyphicon-remove"></span></button>' +
			'</td>' +
			'</tr>'
	);
});

var i = 1;
$('#add100').on('click',function () {
	i++;
	$('#dynamic-field100').append('' +
			'<tr id="row_accessory'+i+'">' +
			'<td>' +
			'<select class="form-control" name="accessory_month[]">' +
			'<option value="">Month</option>' +
			'<option value="1">January</option>' +
			'<option value="2">February</option>' +
			'<option value="3">March</option>' +
			'<option value="4">April</option>' +
			'<option value="5">May</option>' +
			'<option value="6">June</option>' +
			'<option value="7">July</option>' +
			'<option value="8">August</option>' +
			'<option value="9">September</option>' +
			'<option value="10">October</option>' +
			'<option value="11">November</option>' +
			'<option value="12">December</option>' +
			'</select>' +
			'</td>' +
			'<td>' +
			'<select class="form-control" name="accessory_session[]">' +
			'<option value="">Session</option>' +
			'<option value="2018">2018</option>' +
			'<option value="2019">2019</option>' +
			'<option value="2020">2020</option>' +
			'<option value="2021">2021</option>' +
			'<option value="2022">2022</option>' +
			'<option value="2023">2023</option>' +
			'<option value="2024">2024</option>' +
			'<option value="2025">2025</option>' +
			'<option value="2026">2026</option>' +
			'<option value="2027">2027</option>' +
			'<option value="2028">2028</option>' +
			'<option value="2029">2029</option>' +
			'<option value="2030">2030</option>' +
			'</select>' +
			'</td>' +
			'<td>' +
			'<input type="text" name="accessory_amount[]" id="name" class="form-control" placeholder="Enter Amount">' +
			'</td>' +
			'<td>' +
			'<button type="button"td class="btn btn-danger btn_remove10" name="remove" id="'+i+'"><span class="glyphicon glyphicon-remove"></span></button>' +
			'</td>' +
			'</tr>'
	);
});
$(document).on('click','#add_demand',function () {
	i++;
	$('#demand_setting').append(
			'<tr id="row_demand'+i+'" class="invoice_fees">' +
			'<td>' +
			'<input type="text" name="name[]" id="name" class="form-control invoice" data-count="'+i+'" placeholder="Product Name" autocomplete= "off">' +
			'<input type="hidden" name="id[]" id="ids'+i+'" class="form-control pid" data-count="'+i+'" placeholder="Product Name" autocomplete= "off">' +
			'<div id="values'+i+'"></div>' +
			'</td>' +
			'<td>' +
			'<input type="text" name="quantity[]" class="form-control qty" placeholder="Quantity">' +
			'</td>' +
			'<td>' +
			'<input type="text" name="price[]" class="form-control price" placeholder="Price">' +
			'</td>' +
			'<td>' +
			'<button type="button" class="btn btn-danger price_remove remove_demand" id="'+i+'"><span class="glyphicon glyphicon-remove"></span></button>' +
			'</td>' +
			'</tr>');
});

$(document).on('click','.remove_demand',function () {
	var button_id = $(this).attr("id");
	$('#row_demand'+button_id+'').remove();
});

$(document).on('click','.btn_remove10',function () {
	var button_id = $(this).attr("id");
	$('#row_accessory'+button_id+'').remove();
});




$(document).on('click','.btn_remove2',function () {
	var button_id = $(this).attr("id");
	$('#row_exam'+button_id+'').remove();
});

$(document).on('click','.btn_remove3',function () {
	var button_id = $(this).attr("id");
	$('#row_form'+button_id+'').remove();
});

$(document).on('click','.btn_remove4',function () {
	var button_id = $(this).attr("id");
	$('#row_fine'+button_id+'').remove();
});

$(document).on('click','.btn_remove5',function () {
	var button_id = $(this).attr("id");
	$('#row_attendence'+button_id+'').remove();
});




$("#print").click(function(){
	$('.print-hide').hide();
	$("#values").show().printMe();
});

$("#print1").click(function(){
	$("#values1").show().printMe();
});

dycalendar.draw({
	target : "#calender",
	type : "month",
	highlighttoday: true
});