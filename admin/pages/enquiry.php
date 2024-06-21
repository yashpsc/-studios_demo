<?php 
session_start();
function emailformatter($email)
{
    $data = explode("@", $email);
    if ($_SESSION['role'] == 'super admin' OR $_SESSION['role'] == 'admin')
    {
        return $email;
    }
    else
    {
        return substr_replace($data[0],'********', 2,6).'@'.$data[1];
    }
}
function phoneformatter($phone)
{ 
    if ($_SESSION['role'] == 'super admin' OR $_SESSION['role'] == 'admin')
    {
        return $phone;
    }
    else
    {
        if(!empty($phone))
        {
            $phone = substr_replace($phone,'********', 2,8);
        }
        return $phone;
    }
}
?>

<div class="inner" style="min-height: 500px;">
    <div class="row">
        <div class="col-lg-12">

            <h2 style="margin-top: 25px;"> Enqiry Information </h2>
            <input type="text" id="searchfor" placeholder="Search Here.." style=" position: absolute; width: 191px;left: 700px; margin-top: -36px;">
        </div>
    </div>

    <hr />

    <div class="row">
        <div class="col-lg-12">
            <div class="">

                <div class="">
                    <div class="table-responsive" style=" width: 100%; overflow:scroll; max-height: 80vh;">
                        <div class="form-group maxRows">
                            <select class  ="form-control" name="state" id="maxRows">
                                 <option value="5000">Show ALL Rows</option>
                                 <option value="5">5</option>
                                 <option value="10">10</option>
                                 <option value="15">15</option>
                                 <option value="20">20</option>
                                 <option value="50">50</option>
                                 <option value="70">70</option>
                                 <option value="100">100</option>
                            </select>
                        </div>
                        <table id="projectTable" class="table table-bordered ">
                            <thead>
                                <tr>
                                   <!--  <th style="text-align: center;">Serial No.</th> -->
                                    <th style="text-align: center;">Name</th>
                                    <th style="text-align: center;display:none;">Detail Link</th>
                                    <th style="text-align: center;">Email</th>
                                    <th style="text-align: center;">Phone</th>
                                    <th style="text-align: center;">Location</th>
                                    <th style="text-align: center;">City</th>
                                    <th style="text-align: center;">Pincode</th>
                                    <th style="text-align: center;">Comment</th>
                                    <th style="text-align: center;">Status</th>
                                    <th style="text-align: center;">IP</th>
                                    <th style="text-align: center;">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $sr = 0;
                                $sql = "SELECT * from enquire ORDER BY id DESC";
                                $result = $conn->query($sql);
                                if ($result->num_rows>0)
                                {
                                    while($enquirer = $result->fetch_assoc())
                                    {
                                        $sr++; 
                                    ?>
                                        <tr class="tosearch color edit" id="<?php  echo $enquirer['id'];?>">
                                            <!-- <td style="text-align: center;" class="cid"><?php  echo $sr;?></td> -->
                                            <td style="text-align: left;" class="name"><?php  echo $enquirer['name'];?></td>
                                            <td style="text-align: left; display:none;" class="id"><a href="enquirydetail" class="link">link</a></td>
                                            <td style="text-align: center; " class="email" ><?php  echo $enquirer['email'];?></td>
                                            <td style="text-align: center;" class="phone" ><?php  echo phoneformatter($enquirer['phone']);?></td>
                                            <td style="text-align: center;" class="country"><?php  echo $enquirer['location'];?></td>
                                            <td style="text-align: center;" class="city"><?php  echo $enquirer['city'];?></td>
                                            <td style="text-align: center;" class="pincode"><?php  echo $enquirer['pincode'];?></td>
                                            <td style="text-align: center;" class="comment"><?php  echo $enquirer['comment'];?></td>
                                            <td style="text-align: center;" class="comment"><?php  echo $enquirer['status'];?></td>
                                            <td style="text-align: center;" class="ip"><?php  echo $enquirer['ip'];?></td>
                                            <td style="text-align: center;" class="date"><?php  echo $enquirer['created_date'];?></td>
                                        </tr>
                                    <?php
                                    } 
                                } ?>
                            </tbody>
                        </table>
                        <button class="excell_btn" onclick="tableToExcel('projectTable', 'Enquiry List')">Export</button>
                        <div class='pagination-container' id="pagination-container" >
                            <nav>
                                <ul class="pagination">
                                    <li data-page="prev" >
                                        <span> < <span class="sr-only">(current)</span></span>
                                    </li>
                                    <li data-page="next" id="prev">
                                        <span> > <span class="sr-only">(current)</span></span>
                                    </li>
                              </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script type="text/javascript">
    // Table Pagination
    getPagination('#projectTable');
    function getPagination(table) 
    {
        jQuery(document).ready(function($){
      var lastPage = 1;

      $('#maxRows').on('change', function(evt) {
         lastPage = 1;
          $('.pagination')
            .find('li')
            .slice(1, -1)
            .remove();
          var trnum = 0; // reset tr counter
          var maxRows = 12; 

          if (maxRows == 200) {
            $('.pagination').hide();
          } else {
            $('.pagination').show();
          }

          var totalRows = $(table + ' tbody tr').length; // numbers of rows
          $(table + ' tr:gt(0)').each(function() {
            // each TR in  table and not the header
            trnum++; // Start Counter
            if (trnum > maxRows) {
              // if tr number gt maxRows

              $(this).hide(); // fade it out
            }
            if (trnum <= maxRows) {
              $(this).show();
            } // else fade in Important in case if it ..
          }); //  was fade out to fade it in
          if (totalRows > maxRows) {
            // if tr total rows gt max rows option
            var pagenum = Math.ceil(totalRows / maxRows); // ceil total(rows/maxrows) to get ..
            //  numbers of pages
            for (var i = 1; i <= pagenum; ) {
              // for each page append pagination li
              $('.pagination #prev')
                .before(
                  '<li data-page="' +
                    i +
                    '">\
                                      <span>' +
                    i++ +
                    '<span class="sr-only">(current)</span></span>\
                                    </li>'
                )
                .show();
            } // end for i
          } // end if row count > max rows
          $('.pagination [data-page="1"]').addClass('active'); // add active class to the first li
          $('.pagination li').on('click', function(evt) {
            // on click each page
            evt.stopImmediatePropagation();
            evt.preventDefault();
            var pageNum = $(this).attr('data-page'); // get it's number

            var maxRows = 12; // get Max Rows from select option

            if (pageNum == 'prev') {
              if (lastPage == 1) {
                return;
              }
              pageNum = --lastPage;
            }
            if (pageNum == 'next') {
              if (lastPage == $('.pagination li').length - 2) {
                return;
              }
              pageNum = ++lastPage;
            }

            lastPage = pageNum;
            var trIndex = 0; // reset tr counter
            $('.pagination li').removeClass('active'); // remove active class from all li
            $('.pagination [data-page="' + lastPage + '"]').addClass('active'); // add active class to the clicked
            // $(this).addClass('active');                  // add active class to the clicked
            limitPagging();
            $(table + ' tr:gt(0)').each(function() {
              // each tr in table not the header
              trIndex++; // tr index counter
              // if tr index gt maxRows*pageNum or lt maxRows*pageNum-maxRows fade if out
              if (
                trIndex > maxRows * pageNum ||
                trIndex <= maxRows * pageNum - maxRows
              ) {
                $(this).hide();
              } else {
                $(this).show();
              } //else fade in
            }); // end of for each tr in table
          }); // end of on click pagination list
          limitPagging();
        })
        .val(5)
        .change();
      // end of on select change

      // END OF PAGINATION
      });
    }

    function limitPagging(){
        jQuery(document).ready(function($){
            if($('.pagination li').length > 7 ){
                    if( $('.pagination li.active').attr('data-page') <= 3 ){
                    $('.pagination li:gt(5)').hide();
                    $('.pagination li:lt(5)').show();
                    $('.pagination [data-page="next"]').show();
                }if ($('.pagination li.active').attr('data-page') > 3){
                    $('.pagination li:gt(0)').hide();
                    $('.pagination [data-page="next"]').show();
                    for( let i = ( parseInt($('.pagination li.active').attr('data-page'))  -2 )  ; i <= ( parseInt($('.pagination li.active').attr('data-page'))  + 2 ) ; i++ ){
                        $('.pagination [data-page="'+i+'"]').show();

                    }

                }
            }
        });
    }

    jQuery(document).ready(function($) {
      // Just to append id number for each row
      $('table tr:eq(0)').prepend('<th class="pagingclass"> Serial No. </th>');

      var id = 0;

      $('table tr:gt(0)').each(function() {
        id++;
        $(this).prepend('<td class="pagingclass cid">' + id + '</td>');
      });
    });

    // Download Data
    var tableToExcel = (function() {
    var uri = 'data:application/vnd.ms-excel;base64,'
        , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
        , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
        , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
      return function(table, name) {
        if (!table.nodeType) table = document.getElementById(table)
        var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
        name = name?name+'.xls':'excel_data.xls';
        // Create download link element
        downloadLink = document.createElement("a");
        document.body.appendChild(downloadLink);
        if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
        type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, name);
        }else{
        // Create a link to the file
        downloadLink.href = uri + base64(format(template, ctx));
        // Setting the file name
        downloadLink.download = name;
        //triggering the function
        downloadLink.click();
        }
      }
    })();
</script>