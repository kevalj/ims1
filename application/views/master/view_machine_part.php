<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script> 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css"/>



<div id="page-wrapper">
    <div class="main-page">
        <div class="tables">
            <h2 class="title1">View Machine Part Stock Details</h2>
            <a href="<?php echo base_url(); ?>index.php/master/machine_part" class="btn btn-primary">Add Machine Part Stock</a>
            <button type="button" class="btn btn-primary" onclick="deletedata()">Delete Machine Part Stock</button>
			<!--<button type="button" class="btn btn-primary" onclick="servicecenter()">Transfer To Service Center</button>-->

            <div class="panel-body widget-shadow">

                <table class="table" id="vehicle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Machine Part Name</th>
                            <th>Stock Count</th>
                            <th>Insert Date</th>                            
                            <th>Inserted By</th>                            
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
            url: "<?php echo base_url(); ?>index.php/master/getmachinePartData",
            type: 'POST'
        },
    });

    function editdata() {
        var id = $("input[name='id']:checked").val();
        //alert(id);
        location.href = "<?php echo base_url(); ?>index.php/master/editMachinePartData?id=" + id;

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
            url: '<?php echo base_url(); ?>index.php/master/deleteMachinePartData',
            data: postData,
            success: function(data) {
                alert(data);
                table.destroy();
                table = $('#vehicle').DataTable({
                    "pageLength": 10,
                    "ajax": {
                        url: "<?php echo base_url(); ?>index.php/master/getMachinePartData",
                        type: 'POST'
                    },
                });

            }
        });
    }

	function servicecenter(){
						var id=$("input[name='id']:checked"). val();
						//alert(id);
						location.href = "<?php echo base_url(); ?>index.php/InventoryTransfer/inventoryToServiCecenter?id="+id;

					}
</script>

