<?php


class WIPermissions
{
      public function __construct() {
        $this->WIdb = WIdb::getInstance();
    }

    public function PermissionTabs()
    {

        $sql = "SELECT * 
FROM wi_user_roles";
        $query = $this->WIdb->prepare($sql);
        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        echo ' <script>
                $( function() {
                  $( "#tabs" ).tabs();
                } );
                </script>

                <div id="tabs">
              <ul>';
         foreach ($result as $tab) {
          echo  '<li><a href="#tabs-' . $tab['role_id'] . '">' . $tab['role'] . '</a></li>';
        }
        echo '</ul>';

        foreach ($result as $tab) {
          echo  '<div id="tabs-' . $tab['role_id'] . '">
                <form  class="form-horizontal permissions">
                    <fieldset>
                      <div id="legend">
                        <legend class="">' . $tab['role'] . ' Permissions</legend>
                      </div> <div class="content"> ';

          self::UserGroups($tab['role_id']);
         //include_once 'WIInc/site/permissions/' . $tab['role'] . '.php';
                echo '</div> <div class="form-group">';
            self::createPermission($tab['role_id'],$tab['role']);
                    echo ' </div>';
                  echo '</fieldset></form></div>'; 
        }

    }

    public function UserGroups($role_id)
    {
      $UserGroups = $this->WIdb->select("SELECT * FROM `wi_user_group`");
      //var_dump($UserGroups);
      foreach ($UserGroups as $group) {
        echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
         <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">' . $group['group'] . '</div>

                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">Permission</div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">Create</div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">Edit</div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">View</div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">Delete</div>
                        </div>
                     ';
                     self::getColumns($role_id, $group['id']);
                     echo '</div>';
        
      }
    }

    public function getColumns($role_id, $group)
    {
      //echo $role_id;
      $permissions = $this->WIdb->select("SELECT * FROM `wi_user_permissions` WHERE `role_id`=:role_id AND `group`=:group", array("role_id" => $role_id, "group" => $group)
    );
      //var_dump($permissions);
      foreach ($permissions as $perm ) {
        echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    ' . $perm['perm_name'] . '
                  </div>

                  <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                   <a href="javascript:void();" onclick="WIPermissions.change(`' . $perm['id'] . '`, `create`)" class="toggler no" value="' . $perm['create'] . '" id="create-' . $perm['id'] . '">&nbsp;</a>
                  </div>

                      <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                        <a href="javascript:void();" onclick="WIPermissions.change(`' . $perm['id'] . '`, `edit`)" class="toggler no" value="' . $perm['edit'] . '" id="edit-' . $perm['id'] . '">&nbsp;</a>
                </div>
                  
                  <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                    <a href="javascript:void();" onclick="WIPermissions.change(`' . $perm['id'] . '`, `view`)" class="toggler no" value="' . $perm['view'] . '" id="view-' . $perm['id'] . '">&nbsp;</a>
                  
                  </div>

                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                    <a href="javascript:void();" onclick="WIPermissions.change(`' . $perm['id'] . '`, `delete`)" class="toggler no" value="' . $perm['delete'] . '" id="del-' . $perm['id'] . '">&nbsp;</a>
                  </div></div>

                       <script type="text/javascript">
                       var edit = $("#edit-'. $perm['id']. '").attr(`value`);
                       if (edit === "0"){
                        $("#edit-'. $perm['id']. '").addClass(`no`);
                       }else if (edit === "1"){
                        $("#edit-'. $perm['id']. '").removeClass(`no`)
                       }

                        var create = $("#create-'. $perm['id']. '").attr(`value`);
                       if (create === "0"){
                        $("#create-'. $perm['id']. '").addClass(`no`);
                       }else if (create === "1"){
                        $("#create-'. $perm['id']. '").removeClass(`no`)
                       }

                        var del = $("#del-'. $perm['id']. '").attr(`value`);
                       if (del === "0"){
                        $("#del-'. $perm['id']. '").addClass(`no`);
                       }else if (del === "1"){
                        $("#del-'. $perm['id']. '").removeClass(`no`)
                       }

                        var view = $("#view-'. $perm['id']. '").attr(`value`);
                       if (view === "0"){
                        $("#view-'. $perm['id']. '").addClass(`no`);
                       }else if (view === "1"){
                        $("#view-'. $perm['id']. '").removeClass(`no`)
                       }
                   
                      </script>';
      }
    }

    public function PermGroup($role_id)
    {
              $sql = "SELECT * 
FROM wi_user_group";
        $query = $this->WIdb->prepare($sql);
        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        echo '<select id="groups' . $role_id . '" class="col-md-12 col-lg-12 col-xs-12">';
        foreach ($result as $group) {
            echo '<option id="' . $group['id'] . '" value="' . $group['id'] . '">' . $group['group'] . '</option>';
        }

        echo '</select><script type="javascript/text">
              $("select#groups' . $role_id . '").on("change", function() {
                           // alert( this.value );

            $("select#groups' . $role_id . '").attr("value" , this.value );

      });</script>';
    }

    public function createPermission($role_id, $role)
    {
      echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">'; self::PermGroup($role_id); echo'</div>
      <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">Create Permission</div>
      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
      <input type="text" id="permissionName' . $role_id . '" name="Create Permission" style="width:100%;">
      </div>
      <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
      <a href="javascript:void(0);" class="btn" onclick="WIPermissions.CreateNewPermission(`' . $role_id . '`,`' . $role . '`)">Create</a>
      </div>
      </div>';
    }

    public function CreateNewPermission($role_id, $role, $permName, $group)
    {
      $this->WIdb->insert('wi_user_permissions', array(
            "perm_name"     => $permName,
            "role_id"  => $role_id,
            "group"  => $group
        )); 

       $msg = "completed";
      $result = array(
                "status" => "successful",
                "msg"  => $msg
            );
            
            //output result
            echo json_encode ($result);    
    }


    public function GroupPermissionTabs()
    {

        $sql = "SELECT * 
FROM wi_user_group";
        $query = $this->WIdb->prepare($sql);
        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($result);
                  echo  '<form class="form-horizontal permissions">
                    <fieldset>
                      <div id="legend">
                        <legend class="">Group Permissions</legend>
                      </div> <div class="content">';

                      echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
         <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">Group</div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">Edit</div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">Delete</div>
                        </div>';
      foreach ($result as $group) {

        echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
         <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">' . $group['group'] . '</div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">&times;</div>
                        </div>';

        //foreach ($result as $tab) {
         // self::PermissionGroups();
         //include_once 'WIInc/site/permissions/' . $tab['role'] . '.php';
               
        }
         echo '</div> <div class="form-group">';
            self::createNewGroup();
                    echo ' </div>';
                  echo '</fieldset></form><div id="Presult"></div>'; 
    }


        public function PermissionGroups()
    {
      $UserGroups = $this->WIdb->select("SELECT * FROM `wi_user_group`");
      //var_dump($UserGroups);
              echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
         <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">Group</div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">Edit</div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">Delete</div>
                        </div>';
      //foreach ($UserGroups as $group) {

        echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
         <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">' . $UserGroups['group'] . '</div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
                        </div>';
        
      //}
    }

    public function createNewGroup()
    {
      echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">Create Group</div>
      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
      <input type="text" id="permissionGroup" name="Group Permission" style="width:100%;" value="Blog">
      </div>
      <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
      <a href="javascript:void(0);" class="btn" onclick="WIPermissions.createNewGroup()">Create</a>
      </div>
      </div>';
    }


        public function CreateGroupPermission($group)
    {
      $this->WIdb->insert('wi_user_group', array(
            "group"     => $group
        )); 
      $msg = "completed";
      $result = array(
                "status" => "successful",
                "msg"  => $msg
            );
            
            //output result
            echo json_encode ($result);     
    }

}

?>