<?php
include_once 'WI.php';

//csrf protection
if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') 
    die("Sorry bro!");

$url = parse_url( isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '');
if( !isset( $url['host']) || ($url['host'] != $_SERVER['SERVER_NAME']))
    die("Sorry bro!");

$action = $_POST['action'];

switch ($action) {
	case 'checkLogin':
		$logged = $login->userLogin($_POST['username'], $_POST['password']);
        if($logged === true)
            echo json_encode(array(
                'status' => 'success',
                'page'   => get_redirect_page()
            ));
		break;
    case "registerUser":
        $register->register($_POST['User']);
        break;
        
    case "resetPassword":
        $register->resetPassword($_POST['newPass'], $_POST['key']);
        break;
        
    case "forgotPassword":
        $result = $register->forgotPassword($_POST['email']);
        if ( $result !== TRUE )
            echo $result;
        break;
        
    case "postComment":
        $WIComment = new WIComment();
        echo $WIComment->insertComment(WISession::get("user_id"), $_POST['comment']);
        break;
        
    case "updatePassword":
        $user = new WIUser(WISession::get("user_id"));
        $user->updatePassword($_POST['oldpass'], $_POST['newpass']);
        break;
        
    case "updateDetails":
        $user = new WIUser(WISession::get("user_id"));
        $user->updateDetails($_POST['details']);
        break;
        
    case "changeRole":
        onlyAdmin();

        $user = new WIUser($_POST['userId']);
        echo ucfirst($user->changeRole());
        break;
        
    case "deleteUser":
        onlyAdmin();

        $user = new WIUser($_POST['userId']);
        $user->deleteUser();
        break;
    
    case "getUserDetails":
        onlyAdmin();

        $user = new WIUser($_POST['userId']);
        echo json_encode( $user->getAll() );
        break;

    case "addRole": 
        onlyAdmin();

        $role = new WIRole();
        echo json_encode( $role->add($_POST['role']) );
        break;

    case "deleteRole":
        onlyAdmin();

        $role = new WIRole();
        $role->delete($_POST['roleId']);
        break;


    case "addUser":
        onlyAdmin();

        $user = new WIUser(null);
        echo json_encode( $user->add($_POST) );
        break;

    case "updateUser":
        onlyAdmin();

        $user = new WIUser($_POST['userId']);
        $user->updateUser($_POST);
        break;

    case "banUser":
        onlyAdmin();

        $user = new WIUser($_POST['userId']);
        $user->updateInfo(array( 'banned' => 'Y' ));
        break;

    case "unbanUser":
        onlyAdmin();

        $user = new WIUser($_POST['userId']);
        $user->updateInfo(array( 'banned' => 'N' ));
        break;

    case "getUser":
        onlyAdmin();

        $user = new WIUser($_POST['userId']);
        echo json_encode($user->getAll());
        break;

            case "send":
        $mess = new WIContact();
        $mess->Contact($_POST['Message']);
        break;

        case "showTheatres":
        $theatres = new WITheatres();
        $theatres->ViewEdittheatre();
        break;

        case "ViewShow":
        $shows = new WIShows();
        $shows ->ViewShow($_POST['show_id']);   
        break;

        case "ViewTheatre":
        $theatre = new WITheatres();
        $theatre ->ViewTheatre($_POST['theatre_id']);   
        break;

        case "company_Info":
        $company = new WICompany();
        $company ->showCompany($_POST['company_id']);   
        break;

        case "company":
        $company = new WICompany();
        $company ->companyInfo($_POST['company_id']);   
        break;

        case "theatre_shows":
        $theatre = new WITheatres();
        $theatre ->theatreShows($_POST['theatre_id']);   
        break;

        case "theatre_Info":
        $theatre = new WITheatres();
        $theatre ->showTheatre($_POST['theatre_id']);   
        break;

        case "theatre":
        $theatre = new WITheatres();
        $theatre ->Theatre_Info($_POST['theatre_id']);   
        break;

        case "cast_Info":
        $cast = new WICast();
        $cast ->showCast($_POST['cast_id']);   
        break;

        case "actor":
        $actor = new WIActor();
        $actor ->ActorInfo($_POST['actor_id']);   
        break;

        case "actor_Info":
        $actor = new WIActor();
        $actor ->showActor($_POST['actor_id']);   
        break;

        case "haveshows":
        $shows = new WIShows();
        $shows->hasShows();
        break;

        case "select_theatre":
        $theatre = new WITheatres();
        $theatre->SelectTheatre();
        break;

        case "select_company":
        $company = new WICompany();
        $company->SelectCompamy();
        break;

        case "postTheatre":
        $theatre = new WITheatres();
        $theatre->InsertTheatre($_POST['name'], $_POST['desc'],$_POST['fline'],$_POST['sline'],$_POST['city'],$_POST['postcode'],$_POST['user'],$_POST['Image']);
        break;

        case "postShow":
        $shows = new WIShows();
        $shows->InsertShows($_POST['name'], $_POST['desc'],$_POST['theatre'],$_POST['company'],$_POST['start_date'],$_POST['end_date'],$_POST['user'],$_POST['Image'], $_POST['cast']);
        break;

        case "postCompany":
        $company = new WICompany();
        $company->InsertCompany($_POST['name'],$_POST['address'],$_POST['bio'],$_POST['user'],$_POST['Image']);
        break;

        case "userRole":
        onlyAdmin();

        $user = new WIUser(WISession::get('user_id'));
        echo json_encode($user->getRole());
        break;

        case "actorRole":
        $actor  = new WIActor();
        $actor->SelectActorRole();
        break;

        case "SearchShows":
        $shows  = new WIShows();
        $shows->searchShows($_POST['search']);
        break;

        case "ShowTrailers":
        $trailers  = new WITrailer();
        $trailers->ShowTrailer();
        break;

       case "NextShowsPage":
        $shows = new WIShows();
        $shows->hasShows($_POST['page']);
        break;





            default:
        
        break;
}

//switch($_GET['action']){
        
        //case "getEvents":
        //$calendar = new WICalendar();
        //$calendar->getEvents($_GET['date']) ;
        //break;
        
       // default:
      //  break;
   // }

function onlyAdmin() {
    $login = new WILogin();
    if ( ! $login->isLoggedIn() ) exit();

    $loggedUser = new WIUser(WISession::get("user_id"));
    if( ! $loggedUser->isAdmin() ) exit();
}