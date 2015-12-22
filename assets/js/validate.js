
function check_less() {
	var absents = document.getElementById('Less_Abs');
	var presents = document.getElementById('Less_Pre');
	if(!absents.checked && !presents.checked ) {
		show_error('Choose Presents or Absents which are less in no..');
		absents.focus();
		return false;
		}
	else {
		return true;
		}
	}
	

function check_RNos() {
	var rnos = document.getElementById('RNos');
	if(rnos.value=="" || rnos.value == null || rnos.value.length == 0 ) {
		show_error('Fill out Students Roll Numbers ..');
		rnos.focus();
		return false;
		}
	else {
		return true;
		}
	}
	
function check_text() {
	if(check_RNos()) {
		reg = /^\d[,\d]*$/;
		var rnos = document.getElementById('RNos');
		if(rnos.value.match(reg)) {
			return true;
			}
		else {
			show_error('Invalid Syntax ...');
			rnos.focus();
			return false;
			}
		}
	}
	
function fill_rnos(name,cls){
	var rnos = document.getElementById('RNos');
	var ab = document.getElementById('Less_'+name);
	$.post("rnos.php",{ Classno : cls}, function(data) {
		var reg1 = /^Error :/;
		if(data.match(reg1)) {
			alert(data);
			return false;
			}
		else {
			ab.checked = true;
			//document.getElementById('Less_Abs').readonly = "readonly";
			$('#Less_Abs').attr("readonly","readonly");
			$('#Less_Pre').attr("readonly","readonly");
			$("#absn").hide();
			rnos.value=data;
			$('#RNos').attr("readonly","readonly");
			return true;
			}
		});
	}

function check_range(max) {
	
	var rnos = document.getElementById('RNos');
	var skey = document.getElementById('Skey');
	if(skey.value == "" || skey.value == null || skey.value.length == 0 ) {
		show_error('Error : Security code is Missing ... Please try again ');
		skey.focus();
		return false;
		}
	if(check_less() && check_text()) {
		arr = rnos.value.split(',');
		var i;
		for (i=0;i<arr.length;i++) {
			if(arr[i]>max || arr[i] <=0 ) {
				show_error('Roll No. '+arr[i]+' out of bound');
				return false;
				}
			if(arr.indexOf(arr[i]) != arr.lastIndexOf(arr[i])) {
				show_error('Roll No '+arr[i]+'  repead more than one time' );
				return false
				}
			}
		$('#error').hide('slow');
		return true;
		}
	else {
		return false;
		}
	}


function check_login() {
	$('#error').hide();
	var user = document.getElementById('UserId');
	var pass = document.getElementById('Password');
	if(user.value=="" || user.value == null || user.value.length == 0 ) {
		show_error('Error : User Id is missing ... Please try again ');
		user.focus();
		return false;
		}
	if(pass.value=="" || pass.value == null || pass.value.length < 7 ) {
		show_error('Error : Password length should be atleast 7 characters ... Please try again');
		pass.focus();
		return false;
		}
	return true;
	}

function check_cls() {
	$('#error').hide();
	var cls = document.getElementById('Cls');
	var gen = document.getElementById('gen');
	if(cls.value=="" || cls.value == null || cls.value.length == 0 ) {
		show_error('Error : Class is missing ... Please try again ');
		cls.focus();
		return false;
		}
	if(gen.value=="" || gen.value == null || gen.value.length == 0 ) {
		show_error('Error : Gender is Missing ... Please try again');
		gen.focus();
		return false;
		}
	return true;
	}
	
function show_error(msg) {
	ht = '<div class="alert alert-error"><a hrer="#" data-dismiss="alert" class="close">&times;</a><strong>'+msg+'</strong></div>';
	$('#error').hide();
	$('#error').html(ht);
	$('#error').slideDown('slow');
	}

function show_success(msg) {
	//alert('x');
	ht = '<div class="alert alert-success"><a hrer="#" data-dismiss="alert" class="close">&times;</a><strong>'+msg+'</strong></div>';
	$('#error').hide();
	$('#error').html(ht);
	$('#error').slideDown('slow');
	}

function show_info(msg) {
	//alert('x');
	ht = '<div class="alert alert-info"><a hrer="#" data-dismiss="alert" class="close">&times;</a><strong>'+msg+'</strong></div>';
	$('#error').hide();
	$('#error').html(ht);
	$('#error').slideDown('slow');
	}

	
function viewcr(branch,clno) {
	
	$('#error').hide();
	
	idno = document.getElementById('Idno');
	male = document.getElementById('Male');
	female = document.getElementById('Female');
	
	var reg = /^N[0-9]{6}$/;
	
	if(!male.checked && !female.checked  ) {
		show_error('Error : Gender of CR is Missing ... Please try again');
		male.focus();
		return false;
		}
		
	if(idno.value == "" || idno.value == null || idno.value.length == 0 ) {
		show_error('Error : Id No is Missing ... Please try again ');
		idno.focus();
		return false;
		}
	
	if(!idno.value.match(reg)) {
		show_error('Error : Invalid Id No ... Please try again ');
		idno.focus();
		return false;
		}
		
	gender = male.checked ? "M":"F";
	
	return display_cr(branch,clno,gender);
	}

function a() {
	a = document.getElementById('sub2');
	
	id = document.getElementById('idno1');
	gen = document.getElementById('gender1');
	
	idno = document.getElementById('Idno');
	male = document.getElementById('Male');
	gender = male.checked ? "M":"F";
	id.value=idno.value;
	gen.value=gender;
	a.submit();
	}	
	
function display_cr(branch,clno,gender) {
	
	$('#confirm').show();
	$.post("viewcr.php",{ Branch : branch, Classno : clno, Gender : gender , 'view' : 'ok'}, function(data) {
		var reg1 = /^Error :/;
		if(data.match(reg1)) {
			alert(data);
			return false;
			}
		else {
			$('#mbody').html(data);
			$('#cr').modal('show');
			return true;
			}	
		});
	return false;
	}

function update_rno(date1,per1,rno1,val1,cls1) {
	var a = confirm("Do you want to edit attendance now?");
	if(a){
	show_info('<i class="icon-spinner"></i> &nbsp; Loading ....please wait');
	$.post("update.php",{ Date1 : date1, Period1 : per1, RNo1 : rno1 , Value1 : val1, Class1 : cls1}, function(data) {
		var reg1 = /^Error :/;
		if(data.match(reg1)) {
			show_error(data);
			//alert(data);
			return false;
			}
		else {
			show_success('<i class="icon-ok"></i> &nbsp; '+data+' Reloading page ...');
			
			alert("Success : Attnedance updated\nReloading page please wait...");
			setTimeout("document.location.href = window.location.href",0000);
			//alert('i am in');
			return true;
			}	
		});
	}
	return false;
	}

function check_id() {
	
	$('#error').hide();
	idno = document.getElementById('Idno');
	skey = document.getElementById('Skey');
	
	var reg = /^N[0-9]{6}$/;
	
	if(idno.value == "" || idno.value == null || idno.value.length == 0 ) {
		show_error('Error : Id No is Missing ... Please try again ');
		idno.focus();
		return false;
		}
	
	if(!idno.value.match(reg)) {
		show_error('Error : Invalid Id No ... Please try again ');
		idno.focus();
		return false;
		}
		
	if(skey.value == "" || skey.value == null || skey.value.length == 0 ) {
		show_error('Error : Security code is Missing ... Please try again ');
		skey.focus();
		return false;
		}
	return true;
	}
	
function check_forgot() {
	
	$('#error').hide();
	uid = document.getElementById('Uid');
	code = document.getElementById('ccode');
	pass1 = document.getElementById('pass1');
	pass2 = document.getElementById('pass2');
	
	var reg = /^N[0-9]{6}$/;
	var reg2 = /^[0-9]{6}$/;
	
	if(uid.value == "" || uid.value == null || uid.value.length == 0 ) {
		show_error('Error : Id No is Missing ... Please try again ');
		uid.focus();
		return false;
		}
	
	if(!uid.value.match(reg)) {
		show_error('Error : Invalid Id No ... Please try again ');
		uid.focus();
		return false;
		}
	if(ccode.value == "" || ccode.value == null || ccode.value.length == 0 ) {
		show_error('Error : Secutiry code is Missing ... Please try again ');
		ccode.focus();
		return false;
		}
	
	if(!ccode.value.match(reg2)) {
		show_error('Error : Invalid Security Code ... Please try again ');
		ccode.focus();
		return false;
		}
	if(pass1.value == "" || pass1.value == null || pass1.value.length == 0 ) {
		show_error('Error : New Password is Missing ... Please try again ');
		pass1.focus();
		return false;
		}
	if(pass2.value == "" || pass2.value == null || pass2.value.length == 0 ) {
		show_error('Error : Retype the Password ... Please try again ');
		pass2.focus();
		return false;
		}
	if(pass2.value != pass1.value  ) {
		show_error('Error : Password not Matched ... Please try again ');
		pass1.focus();
		return false;
		}
		
	return true;
	}
		
function send_notice(){
	CRs = document.getElementById('CRs');
	Students = document.getElementById('Students');
	if(!CRs.checked && !Students.checked){
		show_error('Please check whom you want to send notification.');
		CRs.focus();
		return false;
	}
	sub = document.getElementById('subject');
	mes = document.getElementById('message');
	if(sub.value == null || sub.value == "" ){
		show_error("Please enter subject of message.");
		sub.focus();
		return false;
	}
	if(mes.value == null || mes.value == "" ){
		show_error("Please enter message.");
		mes.focus();
		return false;
	}
	return true;
}


function give_feedback(){
	complaint = document.getElementById('complaint');
	suggestion = document.getElementById('suggestion');
	if(!complaint.checked && !suggestion.checked){
		show_error('Please check feedback type.');
		complaint.focus();
		return false;
	}
	sub = document.getElementById('subject');
	feedback = document.getElementById('feedback');
	if(sub.value == null || sub.value == "" ){
		show_error("Please enter subject of feedback.");
		sub.focus();
		return false;
	}
	if(feedback.value == null || feedback.value == "" ){
		show_error("Please enter feedback.");
		feedback.focus();
		return false;
	}
	return true;
}

function validate_adminreg(){
	fname = document.getElementById('fname');
	userid = document.getElementById('UserId');
	passwd = document.getElementById('Password');
	cpasswd = document.getElementById('CPassword');
	male = document.getElementById('Male');
	female = document.getElementById('Female');
	x1 = document.getElementById('phno');
	x=x1.value;
	phnoreg = "/^[7-9][0-9]{9}$/";
	if(fname.value == null || fname.value == "" || fname.value.length < 7){
		show_error("Please enter full name of length more than 7 characters.");
		fname.focus();
		return false;
	}
	if(userid.value == null || userid.value == "" || userid.value.length < 7){
		show_error("Please enter User Id of length more than 7 characters.");
		userid.focus();
		return false;
	}
	if(fname.value == userid.value || fname.value.toUpperCase() == userid.value.toUpperCase()){
		show_error("Fullname and User Id shouldn't be same.");
		userid.focus();
		return false;
	}
	if(passwd.value == "" || passwd.value == null || passwd.value.length < 7){
		show_error("Please enter Password of length more than 7 characters.");
		passwd.focus();
		return false;
	}
	if(cpasswd.value == "" || cpasswd.value == null || cpasswd.value != passwd.value){
		show_error("Confirmation password doesn't match with Password.");
		cpasswd.focus();
		return false;
	}
	if(!male.checked && !female.checked){
		show_error("Please provide your gender.");
		male.focus();
		return false;
	}
	if(x.isString == true || x[0] < 7 || isNaN(x)!=false|| x.indexOf(" ")!=-1 || x.length!=10 || x==null ||x==""){
		show_error("Please enter a valid phone number.");
		x1.focus();
		return false;
	}
	return true;
}

function validate_adminforgot(){
	uid = document.getElementById('Uid');
	pass1 = document.getElementById('pass1');
	pass2 = document.getElementById('pass2');
	if(uid.value == "" || uid.value == null || uid.value.length == 0 ) {
		show_error("Please enter your user Id.");
		uid.focus();
		return false;
	}
	if(pass1.value == "" || pass1.value == null || pass1.value.length < 7 ) {
		show_error("Please enter password of length more than 7 characters.");
		pass1.focus();
		return false;
		}
	if(pass2.value == "" || pass2.value == null || pass2.value != pass1.value){
		show_error("Confirmation Password doesn't match Password.");
		pass2.focus();
		return false;
		}
	return true;
}


function change_password1(){
	opass = document.getElementById('OPass');
	pass1 = document.getElementById('NPass1');
	pass2 = document.getElementById('NPass2');
	if(opass.value == "" || opass.value == null || opass.value.length < 7 ) {
		show_error("Error : Your current password is missing and is too short.");
		opass.focus();
		return false;
	}
	if(pass1.value == "" || pass1.value == null || pass1.value.length < 7 ) {
		show_error("Please enter password of length more than 7 characters.");
		pass1.focus();
		return false;
		}
	if(pass2.value == "" || pass2.value == null || pass2.value != pass1.value){
		show_error("Confirmation Password doesn't match Password.");
		pass2.focus();
		return false;
		}
	return true;
}


function change_contact(){
	opass = document.getElementById('OPass');
	mno = document.getElementById('MNo');
	x=mno.value;
	
	if(opass.value == "" || opass.value == null || opass.value.length < 7 ) {
		show_error("Error : Your current password is missing and is too short. please try again...");
		opass.focus();
		return false;
	}
	
	
	if(x.isString == true || x[0] < 7 || isNaN(x)!=false|| x.indexOf(" ")!=-1 || x.length!=10 || x==null ||x==""){
		show_error("Error : Contact No is invalid. please try again..");
		mno.focus();
		return false;
	}
	
	return true;
}

function change_photo(){
	opass = document.getElementById('OPass');
	photo = document.getElementById('Photo');
	
	if(opass.value == "" || opass.value == null || opass.value.length < 7 ) {
		show_error("Error : Your current password is missing and is too short. please try again.....");
		opass.focus();
		return false;
	}
	
	if(photo.value == "" || photo.value == null || photo.value.length == 0 ) {
		show_error("Error : No file selected. please try again....");
		photo.focus();
		return false;
	}
	
	return true;
}

function searchStudents(){
	query = document.getElementById('query');
	id = document.getElementById('ID');
	name1 = document.getElementById('NAME');
	if(query.value == null || query.value == ""){
		show_error("Please enter search query.");
		query.focus();
		return false;
	}
	if(id.checked){
		return true;}
	if(name1.checked){
		return	true;}
	else{
		show_error("Please check search option by ID or NAME.");
		id.focus();
		return false;
	}
	
}
