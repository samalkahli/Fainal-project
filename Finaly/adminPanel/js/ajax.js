function getData(data)
{
  //alert('ok');
  if(data == 'dep')
  {
    //console.log( $('fact') );
    var fact = document.getElementById('fact').value;
     //alert(fact);
    $("#department").empty();
    if(fact>0)
    {
      $.get("pages/getDepartment.php?data=dep&fact="+fact, function(data, status)
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
      $.get("pages/getProgram.php?data=pro&department="+department, function(data, status)
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
    //alert(semster+program);
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
  if(data == 'title')
  {
    // console.log(window.location);

    var title = document.getElementById('chapter').value;
    var drop = document.getElementById('drop').value;
    var id = window.location.search;
    const urlPar = new URLSearchParams(id);
    const Cid = urlPar.get('id');
    $("#title").empty();
    
   if (title > 0 )
    {
      // alert(title);
      // alert(Cid);
      $.get("getTitle.php?data=title&id="+Cid+"&chid="+title, function(data, status)
      {
        //alert("Data: " + fact + "\nStatus: " + status); 
          $("#drop").empty(); 
          $('#drop').append(data);
      });
    }
    else
    return false;
  }
  if(data == 'chapter')
  {
    // console.log(window.location);

    var title = document.getElementById('chapter').value;
    var drop = document.getElementById('drop').value;
    var id = window.location.search;
    const urlPar = new URLSearchParams(id);
    const Cid = urlPar.get('id');
    $("#title").empty();
    
   if (title > 0 )
    {
      // alert(title);
      // alert(Cid);
      $.get("getTitle.php?data=title&id="+Cid+"&chid="+title, function(data, status)
      {
        //alert("Data: " + fact + "\nStatus: " + status); 
          $("#drop").empty(); 
          $('#drop').append(data);
      });
    }
    else
    return false;
  }
  if(data == 'cilo')
  {
    // console.log(window.location);

    var title = document.getElementById('chapter').value;
    var drop = document.getElementById('drop').value;
    var id = window.location.search;
    const urlPar = new URLSearchParams(id);
    const Cid = urlPar.get('id');
    $("#title").empty();
    
   if (title > 0 )
    {
      // alert(title);
      // alert(Cid);
      $.get("getCilos.php?data=title&id="+Cid+"&chid="+title, function(data, status)
      {
        //alert("Data: " + fact + "\nStatus: " + status); 
          $("#drop").empty(); 
          $('#drop').append(data);
      });
    }
    else
    return false;
  }
  if(data == 'topic')
  {
    // console.log(window.location);

    var title = document.getElementById('chapter').value;
    var drop = document.getElementById('drop').value;
    $("#title").empty();
    
   if (title > 0 )
    {
      // alert(title);
      // alert(Cid);
      $.get("getTopic.php?data=title&chid="+title, function(data, status)
      {
        //alert("Data: " + fact + "\nStatus: " + status); 
          $("#drop").empty(); 
          $('#drop').append(data);
      });
    }
    else
    return false;
  }
  if(data == 'subtopic')
  {
    // console.log(window.location);

    var title = document.getElementById('chapterNo').value;
    var sub = document.getElementById('sub').value;
    $("#title").empty();
    //alert(title);
   if (title > 0 )
    {
      // alert(title);
      // alert(Cid);
      $.get("getSubTopic.php?data=title&chapterid="+title, function(data, status)
      {
        //alert("Data: " + fact + "\nStatus: " + status); 
          $("#sub").empty(); 
          $('#sub').append(data);
      });
    }
    else
    return false;
  }



  
}
function get()
{
var y = document.getElementById('other');
//alert(y);

 if (y.style.display === "block") {
    y.style.display = "none";
  } else {
    y.style.display = "block";
  }
}



