$(document).ready(function(){
  // //loader
  var loader = `<div class="loader">
    <span class="loader-inner box-1"></span>
    <span class="loader-inner box-2"></span>
    <span class="loader-inner box-3"></span>
    <span class="loader-inner box-4"></span>
  </div>`;

  // message methods
  function messageHide(){
    $('.message').animate({ opacity: 0,top: '0px' }, 'slow');
    setTimeout(function(){ $(".message").html(''); }, 1000);
  }
  messageHide();

  function messageShow(data){
    $(".message").html(data);
    $('.message').animate({ opacity: 1,top: '60px' }, 'slow');

    setTimeout(function(){ messageHide() }, 3000);
  }

  //check login
//=====================

  $("#admin_Login").on("submit", function(e){
    e.preventDefault();
    var username = $('.username').val();
    var password = $('.password').val();
    if(username == '' || password == ''){
     messageShow("<div class='alert alert-danger'>Please fill all the fields.</div>");
    }else{
      $('.card-body').append(loader);
      $.ajax({
        url: './php_files/check_login.php',
        type: 'POST',
        data: {login:'1',name:username,pass:password},
        success: function(data){
          // console.log(data);
          var data = JSON.parse(data);
          if(data.hasOwnProperty('success')){
            messageShow("<div class='alert alert-success'>Logged In successfully.</div>");
            setTimeout(function(){ window.location='dashboard.php'}, 3000);
          }else if(data.hasOwnProperty('error')){
            messageShow("<div class='alert alert-danger'>Username and password are not matched.</div>");
            setTimeout(function(){ messageHide(); }, 2000);
            $('.loader').hide();
          }
        }
      });
    }
  });

  //logout
  //=====================
  $('.logout').click(function(){
    $.ajax({
      url: './php_files/check_login.php',
      type: 'POST',
      data: {logout:'1'},
      success: function(data){
        // console.log(data);
        if(data == '1'){
          setTimeout(function(){ window.location='index.php'}, 1000);
        }
      }
    });
  });


  //add role script
  $("#add-role").on("submit", function(e){
    e.preventDefault();

    var name = $('.role_name').val();
    if(name == ''){
      messageShow("<div class='alert alert-danger'>Role Name Field is Empty.</div>");
    }else{
      var formdata = new FormData(this);
      formdata.append('create-role',1);
      document.getElementsByClassName('card-body')[0].innerHTML += loader;
      $.ajax({
        url: './php_files/member.php',
        type: 'POST',
        data: formdata,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(data){
          if(data.hasOwnProperty('success')){
            messageShow("<div class='alert alert-success'>Saved successfully.</div>");
            setTimeout(function(){ window.location='role.php'}, 1000);
          }else if(data.hasOwnProperty('error')){
            messageShow("<div class='alert alert-danger'>"+data.error+"</div>");
            setTimeout(function(){$('.loader').hide();}, 2000);
          }
        }
      });
    }
  });

  //update role script
  $("#update-role").on("submit", function(e){
    e.preventDefault();

    var name = $('.role_name').val();
    if(name == ''){
      messageShow("<div class='alert alert-danger'>Role Name Field is Empty.</div>");
    }else{
      var formdata = new FormData(this);
      formdata.append("update-role",1);
      document.getElementsByClassName('card-body')[0].innerHTML += loader;
      $.ajax({
        url: './php_files/member.php',
        type: 'POST',
        data: formdata,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(data){
          if(data.hasOwnProperty('success')){
            messageShow("<div class='alert alert-success'>Updated successfully.</div>");
            setTimeout(function(){ window.location="role.php"}, 1000);
          }else if(data.hasOwnProperty('error')){
            messageShow("<div class='alert alert-danger'>"+data.error+"</div>");
            setTimeout(function(){$('.loader').hide();}, 2000);
          }
        }
      });
    }
  });

  //delete role script
  $(".delete-role").on("click", function(){
    var role_id = $(this).data("roid");
    if(confirm("Are you sure want to delete this role.")){
      document.getElementsByClassName('card-body')[0].innerHTML += loader;
      $.ajax({
        url: './php_files/member.php',
        type: 'POST',
        data: {role_delete: role_id},
        dataType: 'json',
        success: function(data){
          if(data.hasOwnProperty('success')){
            messageShow("<div class='alert alert-success'>Data deleted successfully.</div>");
            setTimeout(function(){ window.location.reload()}, 1000);
          }else{
            messageShow("<div class='alert alert-danger'>"+data.error+"</div>");
            setTimeout(function(){$('.loader').hide();}, 2000);
          }
        }
      });
    }
  });

  //add specialization script
  $("#add-Specialization").on("submit", function(e){
    e.preventDefault();
    var name = $('.speci_name').val();
    if(name == ''){
      messageShow("<div class='alert alert-danger'>Specialization Name Field is Empty.</div>");
    }else{
      var formdata = new FormData(this);
      formdata.append('create-speci',1);
      document.getElementsByClassName('card-body')[0].innerHTML += loader;
      $.ajax({
        url: './php_files/member.php',
        type: 'POST',
        data: formdata,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(data){
          if(data.hasOwnProperty('success')){
            messageShow("<div class='alert alert-success'>Saved successfully.</div>");
            setTimeout(function(){ window.location='specialization.php'}, 1000);
          }else if(data.hasOwnProperty('error')){
            messageShow("<div class='alert alert-danger'>"+data.error+"</div>");
            setTimeout(function(){$('.loader').hide();}, 2000);
          }
        }
      });
    }
  });

  //update specialization script
  $("#update-Specialization").on("submit", function(e){
    e.preventDefault();

    var name = $('.speci_name').val();
    if(name == ''){
      messageShow("<div class='alert alert-danger'>Specialization Name Field is Empty.</div>");
    }else{
      var formdata = new FormData(this);
      formdata.append("update-specialization",1);
      document.getElementsByClassName('card-body')[0].innerHTML += loader;
      $.ajax({
        url: './php_files/member.php',
        type: 'POST',
        data: formdata,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(data){
          if(data.hasOwnProperty('success')){
            messageShow("<div class='alert alert-success'>Updated successfully.</div>");
            setTimeout(function(){ window.location="specialization.php"}, 1000);
          }else if(data.hasOwnProperty('error')){
            messageShow("<div class='alert alert-danger'>"+data.error+"</div>");
            setTimeout(function(){$('.loader').hide();}, 2000);
          }
        }
      });
    }
  });

  //delete specialization script
  $(".delete-speci").on("click", function(){
    var speci_id = $(this).data("spid");
    if(confirm("Are you sure want to delete this specialization.")){
      document.getElementsByClassName('card-body')[0].innerHTML += loader;
      $.ajax({
        url: './php_files/member.php',
        type: 'POST',
        data: {speci_delete: speci_id},
        dataType: 'json',
        success: function(data){
          if(data.hasOwnProperty('success')){
            messageShow("<div class='alert alert-success'>Data deleted successfully.</div>");
            setTimeout(function(){ window.location.reload()}, 1000);
          }else{
            messageShow("<div class='alert alert-danger'>"+data.error+"</div>");
            setTimeout(function(){$('.loader').hide();}, 2000);
          }
        }
      });
    }
  });

  //add staff member script
  $("#add-staff").on("submit", function(e){
    e.preventDefault();

    var fname = $('.fname').val();
    var lname = $('.lname').val();
    var gender = $('.gender').val();
    var birth = $('.birth').val();
    var role = $('.role').val();
    var speci = $('.speci').val();
    var address = $('.address').val();
    var city = $('.city').val();
    var state = $('.state').val();
    var phone = $('.phone').val();
    var email = $('.email').val();
    if(fname == ''){
      messageShow("<div class='alert alert-danger'>First Name Field is Empty.</div>");
    }else if(lname == ''){
      messageShow("<div class='alert alert-danger'>Last Name Field is Empty.</div>");
    }else if(gender == ''){
      messageShow("<div class='alert alert-danger'>Gender Field is Empty.</div>");
    }else if(birth == ''){
      messageShow("<div class='alert alert-danger'>Birth Date Field is Empty.</div>");
    }else if(role == ''){
      messageShow("<div class='alert alert-danger'>Role Field is Empty.</div>");
    }else if(speci == ''){
      messageShow("<div class='alert alert-danger'>Specialization Field is Empty.</div>");
    }else if(address == ''){
      messageShow("<div class='alert alert-danger'>Address Field is Empty.</div>");
    }else if(city == ''){
      messageShow("<div class='alert alert-danger'>City Field is Empty.</div>");
    }else if(state == ''){
      messageShow("<div class='alert alert-danger'>State Field is Empty.</div>");
    }else if(phone == ''){
      messageShow("<div class='alert alert-danger'>Phone Field is Empty.</div>");
    }else if(email == ''){
      messageShow("<div class='alert alert-danger'>Email Field is Empty.</div>");
    }else{
      var formdata = new FormData(this);
      formdata.append('create-staff',1);
      document.getElementsByClassName('card-body')[0].innerHTML += loader;
      $.ajax({
        url: './php_files/member.php',
        type: 'POST',
        data: formdata,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(data){
          // console.log(data);
          if(data.hasOwnProperty('success')){
            messageShow("<div class='alert alert-success'>Saved successfully.</div>");
            setTimeout(function(){ window.location='staff-member.php'}, 1000);
          }else if(data.hasOwnProperty('error')){
            messageShow("<div class='alert alert-danger'>"+data.error+"</div>");
            setTimeout(function(){$('.loader').hide();}, 2000);
          }
        }
      });
    }
  });

  //update staff member script
  $("#update-staff").on("submit", function(e){
    e.preventDefault();

    var fname = $('.fname').val();
    var lname = $('.lname').val();
    var gender = $('.gender').val();
    var birth = $('.birth').val();
    var role = $('.role').val();
    var speci = $('.speci').val();
    var address = $('.address').val();
    var city = $('.city').val();
    var state = $('.state').val();
    var phone = $('.phone').val();
    var email = $('.email').val();
    if(fname == ''){
      messageShow("<div class='alert alert-danger'>First Name Field is Empty.</div>");
    }else if(lname == ''){
      messageShow("<div class='alert alert-danger'>Last Name Field is Empty.</div>");
    }else if(gender == ''){
      messageShow("<div class='alert alert-danger'>Gender Field is Empty.</div>");
    }else if(birth == ''){
      messageShow("<div class='alert alert-danger'>Birth Date Field is Empty.</div>");
    }else if(role == ''){
      messageShow("<div class='alert alert-danger'>Role Field is Empty.</div>");
    }else if(speci == ''){
      messageShow("<div class='alert alert-danger'>Specialization Field is Empty.</div>");
    }else if(address == ''){
      messageShow("<div class='alert alert-danger'>Address Field is Empty.</div>");
    }else if(city == ''){
      messageShow("<div class='alert alert-danger'>City Field is Empty.</div>");
    }else if(state == ''){
      messageShow("<div class='alert alert-danger'>State Field is Empty.</div>");
    }else if(phone == ''){
      messageShow("<div class='alert alert-danger'>Phone Field is Empty.</div>");
    }else if(email == ''){
      messageShow("<div class='alert alert-danger'>Email Field is Empty.</div>");
    }else{
      var formdata = new FormData(this);
      formdata.append("update-staff",1);
      document.getElementsByClassName('card-body')[0].innerHTML += loader;
      $.ajax({
        url: './php_files/member.php',
        type: 'POST',
        data: formdata,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(data){
          // console.log(data);
          if(data.hasOwnProperty('success')){
            messageShow("<div class='alert alert-success'>Updated successfully.</div>");
            setTimeout(function(){ window.location="staff-member.php"}, 1000);
          }else if(data.hasOwnProperty('error')){
            messageShow("<div class='alert alert-danger'>"+data.error+"</div>");
            setTimeout(function(){$('.loader').hide();}, 2000);
          }
        }
      });
    }
  });

  //delete staff member script
  $(".delete-staff").on("click", function(){
    var staff_id = $(this).data("stid");
    if(confirm("Are you sure want to delete this staff member.")){
      document.getElementsByClassName('card-body')[0].innerHTML += loader;
      $.ajax({
        url: './php_files/member.php',
        type: 'POST',
        data: {staff_delete: staff_id},
        dataType: 'json',
        success: function(data){
          if(data.hasOwnProperty('success')){
            messageShow("<div class='alert alert-success'>Data deleted successfully.</div>");
            setTimeout(function(){ window.location.reload()}, 1000);
          }else{
            messageShow("<div class='alert alert-danger'>"+data.error+"</div>");
            setTimeout(function(){$('.loader').hide();}, 2000);
          }
        }
      });
    }
  });

  //add group script
  $("#add-group").on("submit", function(e){
    e.preventDefault();
    var name = $('.group_name').val();
    if(name == ''){
      messageShow("<div class='alert alert-danger'>Name Field is Empty.</div>");
    }else{
      var formdata = new FormData(this);
      formdata.append('create',1);
      document.getElementsByClassName('card-body')[0].innerHTML += loader;
      $.ajax({
        url: './php_files/group.php',
        type: 'POST',
        data: formdata,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(data){
          if(data.hasOwnProperty('success')){
            messageShow("<div class='alert alert-success'>Saved successfully.</div>");
            setTimeout(function(){ window.location='group.php'}, 1000);
          }else if(data.hasOwnProperty('error')){
            messageShow("<div class='alert alert-danger'>"+data.error+"</div>");
            setTimeout(function(){$('.loader').hide();}, 2000);
          }
        }
      });
    }
  });

  //update group script
  $("#update-group").on("submit", function(e){
    e.preventDefault();

    var name = $('.group_name').val();
    if(name == ''){
      messageShow("<div class='alert alert-danger'>Name Field is Empty.</div>");
    }else{
      var formdata = new FormData(this);
      formdata.append("update",1);
      document.getElementsByClassName('card-body')[0].innerHTML += loader;
      $.ajax({
        url: './php_files/group.php',
        type: 'POST',
        data: formdata,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(data){
          // console.log(data);
          if(data.hasOwnProperty('success')){
            messageShow("<div class='alert alert-success'>Updated successfully.</div>");
            setTimeout(function(){ window.location="group.php"}, 1000);
          }else if(data.hasOwnProperty('error')){
            messageShow("<div class='alert alert-danger'>"+data.error+"</div>");
            setTimeout(function(){$('.loader').hide();}, 2000);
          }
        }
      });
    }
  });

  //delete group script
  $(".delete-group").on("click", function(){
    var group_id = $(this).data("grid");
    if(confirm("Are you sure want to delete this group.")){
      document.getElementsByClassName('card-body')[0].innerHTML += loader;
      $.ajax({
        url: './php_files/group.php',
        type: 'POST',
        data: {group_delete: group_id},
        dataType: 'json',
        success: function(data){
          if(data.hasOwnProperty('success')){
            messageShow("<div class='alert alert-success'>Data deleted successfully.</div>");
            setTimeout(function(){ window.location.reload()}, 1000);
          }else{
            messageShow("<div class='alert alert-danger'>"+data.error+"</div>");
            setTimeout(function(){$('.loader').hide();}, 2000);
          }
        }
      });
    }
  });

  //add category script
  $("#add-category").on("submit", function(e){
    e.preventDefault();
    var name = $('.cat_name').val();
    if(name == ''){
      messageShow("<div class='alert alert-danger'>Name Field is Empty.</div>");
    }else{
      var formdata = new FormData(this);
      formdata.append('create',1);
      document.getElementsByClassName('card-body')[0].innerHTML += loader;
      $.ajax({
        url: './php_files/category.php',
        type: 'POST',
        data: formdata,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(data){
          console.log(data);
          if(data.hasOwnProperty('success')){
            messageShow("<div class='alert alert-success'>Saved successfully.</div>");
            setTimeout(function(){ window.location='category.php'}, 1000);
          }else if(data.hasOwnProperty('error')){
            messageShow("<div class='alert alert-danger'>"+data.error+"</div>");
            setTimeout(function(){$('.loader').hide();}, 2000);
          }
        }
      });
    }
  });

  //update category script
  $("#update-category").on("submit", function(e){
    e.preventDefault();

    var name = $('.cat_name').val();
    if(name == ''){
      messageShow("<div class='alert alert-danger'>Name Field is Empty.</div>");
    }else{
      var formdata = new FormData(this);
      formdata.append("update",1);
      document.getElementsByClassName('card-body')[0].innerHTML += loader;
      $.ajax({
        url: './php_files/category.php',
        type: 'POST',
        data: formdata,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(data){
          if(data.hasOwnProperty('success')){
            messageShow("<div class='alert alert-success'>Updated successfully.</div>");
            setTimeout(function(){ window.location="category.php"}, 1000);
          }else if(data.hasOwnProperty('error')){
            messageShow("<div class='alert alert-danger'>"+data.error+"</div>");
            setTimeout(function(){$('.loader').hide();}, 2000);
          }
        }
      });
    }
  });

  //delete category script
  $(".delete-category").on("click", function(){
    var cat_id = $(this).data("caid");
    if(confirm("Are you sure want to delete this category.")){
      document.getElementsByClassName('card-body')[0].innerHTML += loader;
      $.ajax({
        url: './php_files/category.php',
        type: 'POST',
        data: {cat_delete: cat_id},
        dataType: 'json',
        success: function(data){
          if(data.hasOwnProperty('success')){
            messageShow("<div class='alert alert-success'>Data deleted successfully.</div>");
            setTimeout(function(){ window.location.reload()}, 1000);
          }else{
            messageShow("<div class='alert alert-danger'>"+data.error+"</div>");
            setTimeout(function(){$('.loader').hide();}, 2000);
          }
        }
      });
    }
  });

  //add membership script
  $("#add-membership").on("submit", function(e){
    e.preventDefault();

    var name = $('.membership_name').val();
    var cat = $('.membership_cat').val();
    var period = $('.membership_period').val();
    var amount = $('.membership_amount').val();
    if(name == ''){
      messageShow("<div class='alert alert-danger'>Name Field is Empty.</div>");
    }else if(cat == ''){
      messageShow("<div class='alert alert-danger'>Category Field is Empty.</div>");
    }else if(period == ''){
      messageShow("<div class='alert alert-danger'>Period Field is Empty.</div>");
    }else if(amount == ''){
      messageShow("<div class='alert alert-danger'>Amount Field is Empty.</div>");
    }else{
      var formdata = new FormData(this);
      formdata.append('create',1);
      document.getElementsByClassName('card-body')[0].innerHTML += loader;
      $.ajax({
        url: './php_files/membership.php',
        type: 'POST',
        data: formdata,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(data){
          // console.log(data);
          if(data.hasOwnProperty('success')){
            messageShow("<div class='alert alert-success'>Saved successfully.</div>");
            setTimeout(function(){ window.location='membership.php'}, 1000);
          }else if(data.hasOwnProperty('error')){
            messageShow("<div class='alert alert-danger'>"+data.error+"</div>");
            setTimeout(function(){$('.loader').hide();}, 2000);
          }
        }
      });
    }
  });

  //update membership script
  $("#update-membership").on("submit", function(e){
    e.preventDefault();

    var name = $('.membership_name').val();
    var cat = $('.membership_cat').val();
    var period = $('.membership_period').val();
    var amount = $('.membership_amount').val();
    if(name == ''){
      messageShow("<div class='alert alert-danger'>Name Field is Empty.</div>");
    }else if(cat == ''){
      messageShow("<div class='alert alert-danger'>Category Field is Empty.</div>");
    }else if(period == ''){
      messageShow("<div class='alert alert-danger'>Period Field is Empty.</div>");
    }else if(amount == ''){
      messageShow("<div class='alert alert-danger'>Amount Field is Empty.</div>");
    }else{
      var formdata = new FormData(this);
      formdata.append("update",1);
      document.getElementsByClassName('card-body')[0].innerHTML += loader;
      $.ajax({
        url: './php_files/membership.php',
        type: 'POST',
        data: formdata,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(data){
          // console.log(data);
          if(data.hasOwnProperty('success')){
            messageShow("<div class='alert alert-success'>Updated successfully.</div>");
            setTimeout(function(){ window.location="membership.php"}, 1000);
          }else if(data.hasOwnProperty('error')){
            messageShow("<div class='alert alert-danger'>"+data.error+"</div>");
            setTimeout(function(){$('.loader').hide();}, 2000);
          }
        }
      });
    }
  });

  //delete membership script
  $(".delete-membership").on("click", function(){
    var membership_id = $(this).data("msid");
    if(confirm("Are you sure want to delete this membership.")){
      document.getElementsByClassName('card-body')[0].innerHTML += loader;
      $.ajax({
        url: './php_files/membership.php',
        type: 'POST',
        data: {membership_delete: membership_id},
        dataType: 'json',
        success: function(data){
          if(data.hasOwnProperty('success')){
            messageShow("<div class='alert alert-success'>Data deleted successfully.</div>");
            setTimeout(function(){ window.location.reload()}, 1000);
          }else{
            messageShow("<div class='alert alert-danger'>"+data.error+"</div>");
            setTimeout(function(){$('.loader').hide();}, 2000);
          }
        }
      });
    }
  });

  function set_GetDate(date,days){
    var someDate = new Date(date);
    someDate.setDate(someDate.getDate() + parseInt(days));
    var now = new Date(someDate);
    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    var today = now.getFullYear()+"-"+(month)+"-"+(day);
    if ( $('.end_date').attr('type') == 'text' ) {
    $('.end_date').attr("type","date");
    $(".end_date").val('');
    }
    $(".end_date").val(today);
  }

  $(".membership").change(function(){
    var id = $(this).val();
    $.ajax({
      url: './php_files/membership.php',
      type: 'POST',
      data: {select_days: id},
      success: function(data){
        $("#select_days").text(data);
        var date = $(".start_date").val();
        set_GetDate(date,data);
      }
    });
  });

  $(".start_date").on('change',function(){
      var numberOfDaysToAdd = $("#select_days").text();
      if(numberOfDaysToAdd == ''){
        $(".end_date").attr("type","text");
        $(".end_date").attr("value","select membership");
      }else{
        var date = $(this).val();
        set_GetDate(date,numberOfDaysToAdd);
      }
  });

  $(".start_date_update").on('change',function(){
      var numberOfDaysToAdd = $("#select_days_update").text();
      if(numberOfDaysToAdd == ''){
        $(".end_date_update").attr("type","text");
        $(".end_date_update").attr("value","select membership");
      }else{
        var date = $(this).val();
        set_GetDate1(date,numberOfDaysToAdd);
      }
  });


  function set_GetDate1(date,days){
    var someDate = new Date(date);
    someDate.setDate(someDate.getDate() + parseInt(days));
    var now = new Date(someDate);
    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    var today = now.getFullYear()+"-"+(month)+"-"+(day);
    if ( $('.end_date_update').attr('type') == 'text' ) {
    $('.end_date_update').attr("type","date");
    $(".end_date_update").val('');
    }
    $(".end_date_update").val(today);
  }

  $(".membership_update").change(function(){
    var id = $(this).val();
    $.ajax({
      url: './php_files/membership.php',
      type: 'POST',
      data: {select_days: id},
      success: function(data){
        // console.log(data);
        $("#select_days_update").text(data);
        var date = $(".start_date_update").val();
        set_GetDate1(date,data);
      }
    });
  });

  //add member script
  $("#add-member").on("submit", function(e){
    e.preventDefault();

    var fname = $('.fname').val();
    var lname = $('.lname').val();
    var gender = $('.gender').val();
    var birth = $('.birth').val();
    var group = $('.group').val();
    var address = $('.address').val();
    var city = $('.city').val();
    var state = $('.state').val();
    var phone = $('.phone').val();
    var email = $('.email').val();
    var staff_member = $('.staff').val();
    var membership = $('.membership').val();
    var start_date = $('.start_date').val();
    if(fname == ''){
      messageShow("<div class='alert alert-danger'>First Name Field is Empty.</div>");
    }else if(lname == ''){
      messageShow("<div class='alert alert-danger'>Last Name Field is Empty.</div>");
    }else if(gender == ''){
      messageShow("<div class='alert alert-danger'>Gender Field is Empty.</div>");
    }else if(birth == ''){
      messageShow("<div class='alert alert-danger'>Birth Date Field is Empty.</div>");
    }else if(group == ''){
      messageShow("<div class='alert alert-danger'>Group Field is Empty.</div>");
    }else if(address == ''){
      messageShow("<div class='alert alert-danger'>Address Field is Empty.</div>");
    }else if(city == ''){
      messageShow("<div class='alert alert-danger'>City Field is Empty.</div>");
    }else if(state == ''){
      messageShow("<div class='alert alert-danger'>State Field is Empty.</div>");
    }else if(phone == ''){
      messageShow("<div class='alert alert-danger'>Phone Field is Empty.</div>");
    }else if(email == ''){
      messageShow("<div class='alert alert-danger'>Email Field is Empty.</div>");
    }else if(staff_member == ''){
      messageShow("<div class='alert alert-danger'>Staff Member Field is Empty.</div>");
    }else if(membership == ''){
      messageShow("<div class='alert alert-danger'>Membership Field is Empty.</div>");
    }else if(start_date == ''){
      messageShow("<div class='alert alert-danger'>Date Field is Empty.</div>");
    }else{
      var formdata = new FormData(this);
      formdata.append("create-member",1);
      document.getElementsByClassName('card-body')[0].innerHTML += loader;
      $.ajax({
        url: './php_files/member.php',
        type: 'POST',
        data: formdata,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(data){
          // console.log(data);
          if(data.hasOwnProperty('success')){
            messageShow("<div class='alert alert-success'>Saved successfully.</div>");
            setTimeout(function(){ window.location="member.php"}, 1000);
          }else if(data.hasOwnProperty('error')){
            messageShow("<div class='alert alert-danger'>"+data.error+"</div>");
            setTimeout(function(){$('.loader').hide();}, 2000);
          }
        }
      });
    }
  });

  //update member script
  $("#update-member").on("submit", function(e){
    e.preventDefault();

    var fname = $('.fname').val();
    var lname = $('.lname').val();
    var gender = $('.gender').val();
    var birth = $('.birth').val();
    var group = $('.group').val();
    var address = $('.address').val();
    var city = $('.city').val();
    var state = $('.state').val();
    var phone = $('.phone').val();
    var email = $('.email').val();
    var staff_member = $('.staff').val();
    var membership = $('.membership').val();
    var start_date = $('.start_date').val();
    if(fname == ''){
      messageShow("<div class='alert alert-danger'>First Name Field is Empty.</div>");
    }else if(lname == ''){
      messageShow("<div class='alert alert-danger'>Last Name Field is Empty.</div>");
    }else if(gender == ''){
      messageShow("<div class='alert alert-danger'>Gender Field is Empty.</div>");
    }else if(birth == ''){
      messageShow("<div class='alert alert-danger'>Birth Date Field is Empty.</div>");
    }else if(group == ''){
      messageShow("<div class='alert alert-danger'>Group Field is Empty.</div>");
    }else if(address == ''){
      messageShow("<div class='alert alert-danger'>Address Field is Empty.</div>");
    }else if(city == ''){
      messageShow("<div class='alert alert-danger'>City Field is Empty.</div>");
    }else if(state == ''){
      messageShow("<div class='alert alert-danger'>State Field is Empty.</div>");
    }else if(phone == ''){
      messageShow("<div class='alert alert-danger'>Phone Field is Empty.</div>");
    }else if(email == ''){
      messageShow("<div class='alert alert-danger'>Email Field is Empty.</div>");
    }else if(staff_member == ''){
      messageShow("<div class='alert alert-danger'>Staff Member Field is Empty.</div>");
    }else if(membership == ''){
      messageShow("<div class='alert alert-danger'>Membership Field is Empty.</div>");
    }else if(start_date == ''){
      messageShow("<div class='alert alert-danger'>Date Field is Empty.</div>");
    }else{
      var formdata = new FormData(this);
      formdata.append("update-member",1);
      document.getElementsByClassName('card-body')[0].innerHTML += loader;
      $.ajax({
        url: './php_files/member.php',
        type: 'POST',
        data: formdata,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(data){
          // console.log(data);
          if(data.hasOwnProperty('success')){
            messageShow("<div class='alert alert-success'>Updated successfully.</div>");
            setTimeout(function(){ window.location="member.php"}, 1000);
          }else if(data.hasOwnProperty('error')){
            messageShow("<div class='alert alert-danger'>"+data.error+"</div>");
            setTimeout(function(){$('.loader').hide();}, 2000);
          }
        }
      });
    }
  });

  //delete member script
  $(".delete-member").on("click", function(){
    var member_id = $(this).data("mid");
    if(confirm("Are you sure want to delete this member.")){
      document.getElementsByClassName('card-body')[0].innerHTML += loader;
      $.ajax({
        url: './php_files/member.php',
        type: 'POST',
        data: {member_delete: member_id},
        dataType: 'json',
        success: function(data){
          if(data.hasOwnProperty('success')){
            messageShow("<div class='alert alert-success'>Data deleted successfully.</div>");
            setTimeout(function(){ window.location.reload()}, 1000);
          }else{
            messageShow("<div class='alert alert-danger'>"+data.error+"</div>");
            setTimeout(function(){$('.loader').hide();}, 2000);
          }
        }
      });
    }
  });

  //member attendance script
  $(".member-attendance").hide();
  $("#show-attendance").on("submit", function(e){
    e.preventDefault();

    var date = $('.date').val();
    var group = $('.group').val();
    if(date == ''){
      messageShow("<div class='alert alert-danger'>Date Field is Empty.</div>");
    }else if(group == ''){
      messageShow("<div class='alert alert-danger'>Group Field is Empty.</div>");
    }else{
      var formdata = new FormData(this);
      formdata.append('member-attendance',1);
      $.ajax({
        url: './php_files/attendance.php',
        type: 'POST',
        data: formdata,
        processData: false,
        contentType: false,
        success: function(data){
          // console.log(data);
          if(data != ''){
            $('.member-attendance table tbody').html(data);
            $('.member-table').DataTable({
              retrieve: true,
              paging: false
            });
            $('.member-attendance').show();
          }
        }
      });
    }
  });

  $('.save-att').click(function(){
    var data = [];
    $('.member_id').each(function(){
      var id = $(this).val();
      if($('#checkbox'+id).prop('checked') == true){
        data[id] = 1;
      }else{
        data[id] = 0;
      }
    });
    $.ajax({
      url: './php_files/attendance.php',
      type: 'POST',
      data: {add_att:data},
      success: function(data){
        // console.log(data);
        if(data == 1){
          messageShow("<div class='alert alert-success'>Attendance saved successfully.</div>");
        }else{
          messageShow("<div class='alert alert-danger'>"+data+"</div>");
        }
      }
    });
  });

  //staff member attendance script
  $('.save-staff-att').click(function(){
    var data = [];
    var date = $('.staff_date').val();
    $('.staff_id').each(function(){
      var id = $(this).val();
      if($('#checkbox'+id).prop('checked') == true){
        data[id] = 1;
      }else{
        data[id] = 0;
      }
    });
    $.ajax({
      url: './php_files/attendance.php',
      type: 'POST',
      data: {add_staff_att:data,staff_date:date},
      success: function(data){
        // console.log(data);
        if(data == 1){
          messageShow("<div class='alert alert-success'>Attendance saved successfully.</div>");
        }else{
          messageShow("<div class='alert alert-danger'>"+data+"</div>");
        }
      }
    });
  });

  //staff member attendance on change script
  $(".staff_date").on("change", function(){
    var date = $(this).val();
    if(date == ''){
      messageShow("<div class='alert alert-danger'>Date Field is Empty.</div>");
    }else{
      $.ajax({
        url: './php_files/attendance.php',
        type: 'POST',
        data: {current_date:date},
        success: function(data){
          // console.log(data);
          if(data != ''){
            $('.staff-attendance table tbody').html(data);
            $('.staff-table').DataTable({
              retrieve: true,
              paging: false
            });
          }
        }
      });
    }
  });

  //update profile_settings script
  $("#update-profile").on("submit", function(e){
    e.preventDefault();
    var admin_name = $('.name').val();
    var admin_email = $('.email').val();
    var admin_phone = $('.admin_phone').val();
    var admin_address = $('.address').val();
    var admin_username = $('.username').val();
    if(admin_name == ''){
      messageShow("<div class='alert alert-danger'>Name Field is Empty.</div>");
    }else if(admin_phone == ''){
      messageShow("<div class='alert alert-danger'>Phone Field is Empty.</div>");
    }else if(admin_email == ''){
      messageShow("<div class='alert alert-danger'>Email Field is Empty.</div>");
    }else if(admin_address == ''){
      messageShow("<div class='alert alert-danger'>Address Field is Empty.</div>");
    }else if(admin_username == ''){
      messageShow("<div class='alert alert-danger'>Username Field is Empty.</div>");
    }else{
      var formdata = new FormData(this);
      formdata.append('update-profile',1);
      document.getElementsByClassName('card-body')[0].innerHTML += loader;
      $.ajax({
        url: './php_files/profile.php',
        type: 'POST',
        data: formdata,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(data){
          // console.log(data);
          if(data.hasOwnProperty('success')){
            messageShow("<div class='alert alert-success'>Profile Updated successfully.</div>");
            setTimeout(function(){ window.location.reload();}, 2000);
          }else if(data.hasOwnProperty('login')){
            messageShow("<div class='alert alert-success'>Please Login with New username and Password.</div>");
            setTimeout(function(){ window.location.reload();}, 3000);
          }else{
            messageShow("<div alert='alert alert-danger'>Server side error.</div>");
            setTimeout(function(){$('.loader').hide();}, 2000);
          }
        }
      });
    }
  });

  //update settings script
  //=====================
  $("#update-settings").on("submit", function(e){
    e.preventDefault();
    var gym_name = $('.gym_name').val();
    var gym_currency = $('.gym_currency').val();

    if(gym_name == ''){
      messageShow("<div class='alert alert-danger'>Gym Name Field is Empty.</div>");
    }else if(gym_currency == ''){
      messageShow("<div class='alert alert-danger'>Currency Format Field is Empty.</div>");
    }else{
      var formdata = new FormData(this);
      formdata.append('update-settings',1);
      document.getElementsByClassName('card-body')[0].innerHTML += loader;
      $.ajax({
        url: './php_files/setting.php',
        type: 'POST',
        data: formdata,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(data){
          if(data.hasOwnProperty('success')){
            messageShow("<div class='alert alert-success'>Setting updated successfully.</div>");
            setTimeout(function(){ window.location.reload();}, 2000);
          }else{
            messageShow("<div class='alert alert-danger'>"+data.error+"</div>");
            setTimeout(function(){$('.loader').hide();}, 2000);
          }
        }
      });
    }
  });

  //member attendance script
  $(".attendance-report").hide();
  $("#attendance-report").on("submit", function(e){
    e.preventDefault();

    var start_date = $('.start_date').val();
    var end_date = $('.endd_date').val();
    if(start_date == ''){
      messageShow("<div class='alert alert-danger'>Start Date Field is Empty.</div>");
    }else if(end_date == ''){
      messageShow("<div class='alert alert-danger'>End Date Field is Empty.</div>");
    }else{
      var formdata = new FormData(this);
      formdata.append('attendance-report',1);
      $.ajax({
        url: './php_files/reports.php',
        type: 'POST',
        data: formdata,
        processData: false,
        contentType: false,
        success: function(data){
          // console.log(data);
          if(data != ''){
            $('.attendance-report table tbody').html(data);
            $('.attendance-table').DataTable({
              retrieve: true,
              paging: false
            });
            $('.attendance-report').show();
          }
        }
      });
    }
  });

});
