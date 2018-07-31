<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script> 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css"/>



<div id="page-wrapper">
    <div class="main-page">
        <div class="tables">
            <h2 class="title1">View Service Center</h2>
            <a href="<?php echo base_url(); ?>index.php/master/service_center" class="btn btn-primary">Add Service Center</a>
            <button type="button" class="btn btn-primary" onclick="editdata()">Edit Service Center</button>
            <button type="button" class="btn btn-primary" onclick="deletedata()">Delete Service Center</button>

            <div class="panel-body widget-shadow">

                <table class="table" id="vehicle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Service Center Name</th>
                            <th>Division Name</th>
                            <th>Status</th>

                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>
</div>

<script>
    var table = $('#vehicle').DataTable({
        "pageLength": 10,
        "ajax": {
            url: "<?php echo base_url(); ?>index.php/master/getServiceCenterData",
            type: 'POST'
        },
    });

    function editdata() {
        var id = $("input[name='id']:checked").val();
        //alert(id);
        location.href = "<?php echo base_url(); ?>index.php/master/editServiceCenterData?id=" + id;

    }



    function deletedata() {
        var id = $("input[name='id']:checked").val();
        //alert(id);
        if (id == undefined) {
            alert("Please select to delete");
            return false;
        }
        var postData = {
            "id": id
        };
        $.ajax({
            type: "POST",
            url: '<?php echo base_url(); ?>index.php/master/deleteServiceCenterData',
            data: postData,
            success: function(data) {
                alert(data);
                table.destroy();
                table = $('#vehicle').DataTable({
                    "pageLength": 10,
                    "ajax": {
                        url: "<?php echo base_url(); ?>index.php/master/getServiceCenterData",
                        type: 'POST'
                    },
                });

            }
        });
    }
</script>