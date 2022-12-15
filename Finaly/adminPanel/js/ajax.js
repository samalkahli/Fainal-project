function getData(data)
{
  //alert('ok');
  if(data == 'dep')
  {
    //console.log( $('fact') );
    var fact = document.getElementById('fact').value;
    // alert(fact);
    $("#department").empty();
    if(fact>0)
    {
      $.get("getDepartment.php?data=dep&fact="+fact, function(data, status)
      {
        //alert("Data: " + fact + "\nStatus: " + status); 
          $("#department").empty(); 
          $('#department').append(data);
      });
    }
    
    else 
    return false;
           
  }
  if(data == 'pro')
  {
    //console.log( $('fact') );
    var department = document.getElementById('department').value;
    //alert(department);
    $("#program").empty();
    if(department>0)
    {
      $.get("getProgram.php?data=pro&department="+department, function(data, status)
      {
        //alert("Data: " + fact + "\nStatus: " + status); 
          $("#program").empty(); 
          $('#program').append(data);
      });
    }
    else 
    return false;
  }
  if(data == 'sub')
  {
    //console.log( $('fact') );
    var program = document.getElementById('program').value;
    //alert(program);
    $("#subject").empty();
    if(program>0)
    {
      $.get("getSubject.php?data=sub&program="+program, function(data, status)
      {
        //alert("Data: " + fact + "\nStatus: " + status); 
          $("#subject").empty(); 
          $('#subject').append(data);
      });
    }
    else 
    return false;
  }
  if(data == 'sem')
  {
    //console.log( $('fact') );
    var semster = document.getElementById('semster').value;
    var program = document.getElementById('program').value;
    //alert(semster);
    $("#subject").empty();
    if(semster>0)
    {
      $.get("getSubject.php?data=sem&semster="+semster+"&program="+program, function(data, status)
      {
        //alert("Data: " + fact + "\nStatus: " + status); 
          $("#subject").empty(); 
          $('#subject').append(data);
      });
    }
    else 
    return false;
  }

}