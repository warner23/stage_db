<?php
include_once 'WI.php';
require_once 'WIA.php';
//csrf protection
if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') 
    die("Sorry bro!");

$url = parse_url( isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '');
if( !isset( $url['host']) || ($url['host'] != $_SERVER['SERVER_NAME']))
    die("Sorry bro!");

$action = isset($_POST['action']) ? $_POST['action'] : null;
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

        $user = new WIAdmin(WISession::get("user_id"));
        $user->updatePassword($_POST['oldpass'], $_POST['newpass']);
        break;
        
    case "updateDetails":

        $user = new WIAdmin(WISession::get("user_id"));
        $user->updateDetails($_POST['details']);
        break;
        
    case "changeRole":
        onlyAdmin();

        $user = new WIAdmin($_POST['userId']);
        echo ucfirst($user->changeRole());
        break;
        
    case "deleteUser":
        onlyAdmin();

        $user = new WIAdmin($_POST['userId']);
        $user->deleteUser();
        break;
    
    case "getUserDetails":
        onlyAdmin();

        $user = new WIAdmin($_POST['userId']);
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
        $user = new WIAdmin(null);
        echo json_encode( $user->add($_POST) );
        break;

    case "updateUser":
        onlyAdmin();
        $user = new WIAdmin($_POST['userId']);
        $user->updateUser($_POST);
        break;

    case "banUser":
        onlyAdmin();

        $user = new WIAdmin($_POST['userId']);
        $user->updateInfo(array( 'banned' => 'Y' ));
        break;

    case "unbanUser":
        onlyAdmin();

        $user = new WIAdmin($_POST['userId']);
        $user->updateInfo(array( 'banned' => 'N' ));
        break;

    case "getUser":
        onlyAdmin();

        $user = new WIAdmin($_POST['userId']);
        echo json_encode($user->getAll());
        break;

         case 'site_settings':
        onlyAdmin();
        $site = new WISite();
        $site->Site_Settings($_POST['settings']);
        break;    

 case 'database_settings':
         onlyAdmin();
        $site = new WISite();
        $site->DataBase_settings($_POST['settings']);
        break;

        case "email_settings":
        onlyAdmin();
        $site = new WISite();
        $site->Email_settings($_POST['settings']);
        break;

            case "email_send":
        onlyAdmin();
        $dash = new WIDashboard();
        $dash->Send_Mail($_POST['settings']);
        break;

     case "mailer_settings":
     onlyAdmin();
        $site = new WISite();
        $site->Email_Method($_POST['settings']);
        break;
     
     case "session_settings":
     onlyAdmin();
        $site = new WISite();
        $site->Session_Settings($_POST['settings']);
        break;

    case "verification_settings":
     onlyAdmin();
        $site = new WISite();
        $site->verification_Settings($_POST['settings']);
        break;

        case "encryption":
    onlyAdmin();
        $site = new WISite();
        $site->Security_Settings($_POST['encryption'],$_POST['cost']);
        break;


    case "login_settings":
    onlyAdmin();
        $site = new WISite();
        $site->Login_settings($_POST['settings']);
        break;

    case "social_settings":
    onlyAdmin();
        $site = new WISite();
        $site->social_settings($_POST['settings']);
        break;

    case "header_settings":
    onlyAdmin();
        $web = new WIWebsite();
        $web->headerSettings($_POST['settings']);
        break;

    case "lang_settings":
    onlyAdmin();
        $site = new WISite();
        $site->lang_Settings($_POST['settings']);
        break;

         case "multilanguage":
    onlyAdmin();
        $site = new WISite();
        $site->AddMultiLang($_POST['lang'], $_POST['keyword'],$_POST['trans']);
        break;

        case "multiLang":
    onlyAdmin();
        $web = new WIWebsite(); 
        $web->CheckMultiLang();
        break;

        case "update_Menu":
        onlyAdmin();
        $web = new WIWebsite();
        $web->updateMenu($_POST['settings']);
        break;

        case "EditModLang":
    onlyAdmin();
        $web = new WIWebsite(); 
        $web->EditModLang($_POST['code'], $_POST['keyword'],$_POST['trans'], $_POST['mod_name']);
        break;

         case "EditModLangpara":
    onlyAdmin();
        $web = new WIWebsite(); 
        $web->EditModLangPara($_POST['code'], $_POST['keyword'],$_POST['trans'], $_POST['mod_name']);
        break;

    case "AddLang":
    onlyAdmin();
        $site = new WISite();
        $site->AddLang($_POST['lang']);
        break;

    case "AddCSS":
    onlyAdmin();
        $site = new WISite();
        $site->AddCSS($_POST['CSS']);
        break;

     case "Ele_install":
    onlyAdmin();
        $mod = new WIModules();
        $mod->install_Element($_POST['ele_name'], $_POST['author'] );
        break;

    case "mod_install":
    onlyAdmin();
        $mod = new WIModules();
        $mod->install_mod($_POST['mod_name'], $_POST['author'] );
        break;

    case "mod_uninstall":
    onlyAdmin();
        $mod = new WIModules();
        $mod->uninstall_mod($_POST['mod_name']);
        break;

    case "ele_uninstall":
    onlyAdmin();
        $mod = new WIModules();
        $mod->uninstall_Ele($_POST['mod_name']);
        break;

    case "mod_enable":
    onlyAdmin();
        $mod = new WIModules();
        $mod->active_available_mod($_POST['mod_name'], $_POST['enable'] );
        break;

        case "ele_enable":
    onlyAdmin();
        $mod = new WIModules();
        $mod->active_available_ele($_POST['mod_name'], $_POST['enable'] );
        break;

    case "mod_disable":
    onlyAdmin();
        $mod = new WIModules();
        $mod->deactive_available_mod($_POST['mod_name'], $_POST['disable']);
        break;

    case "ele_disable":
    onlyAdmin();
        $mod = new WIModules();
        $mod->deactive_available_ele($_POST['mod_name'], $_POST['disable']);
        break;

         case "drop_call":
    onlyAdmin();
        $mod = new WIModules();
        $mod->dropElement($_POST['mod_name'], $_POST['mod_drop'], $_POST['empty']);
        break;

        case "drop_mod":
    onlyAdmin();
        $mod = new WIModules();
        $mod->dropModule($_POST['mod_name']);
        break;

            case "col_call":
    onlyAdmin();
        $mod = new WIModules();
        $mod->dropColElement($_POST['mod_name']);
        break;

          case "edit_drop_mod":
    onlyAdmin();
        $mod = new WIModules();
        $mod->editDropElement($_POST['mod_name'], $_POST['page_id']);
        break;

    case "Translations":
    onlyAdmin();
        $web = new WIWebsite();
        $web->viewTrans();
        break;

     case "lang_page":
    onlyAdmin();
        $web = new WIWebsite();
        $web->viewTrans($_POST['page']);
        break;


          case "getInfo":
    onlyAdmin();
        $page = new WIPage();
        $page->PageInfo($_POST['page']);
        break;

    case "Next":
    onlyAdmin();
        $mod = new WIModules();
        $mod->getModules();
        break;

    case "NextactorsPage":
    onlyAdmin();
        $people = new WIPeople();
        $people->ViewEditPeople($_POST['page']);
        break;

        case "NextTheatrePage":
    onlyAdmin();
        $theatres = new WITheatres();
        $theatres->ViewEdittheatre($_POST['page']);
        break;

    case "NextNotification":
    onlyAdmin();
        $dash = new WIDashboard();
        $dash->WINotifications($_POST['page']);
        break;

     case "NextPage":
    onlyAdmin();
        $mod = new WIModules();
        $mod->getModules($_POST['page']);
        break;

             case "NextPage":
    onlyAdmin();
        $mod = new WIModules();
        $mod->getModules($_POST['page']);
        break;

    case "NextMod":
    onlyAdmin();
        $mod = new WIModules();
        $mod->getActiveMods($_POST['page']);
        break;

     case "NextModPage":
    onlyAdmin();
        $mod = new WIModules();
        $mod->getActiveMods();
        break;

    case "getLangInfo":
    onlyAdmin();
        $web = new WIWebsite();
        $web->getLangInfo($_POST['lang']);
        break;

     case "sendmessage":
     onlyAdmin();
        $chat = new WIAdminChat();
        $chat->SendMessage($_POST['Message'], $_POST['user_id']);
        break;

    case "todoListcomplete":
    onlyAdmin();
        $dash = new WIDashboard();
        $dash->completetodo($_POST['id']);
        break;

    case "todoListAdd":
    onlyAdmin();
        $dash = new WIDashboard();
        $dash->addToDoListItem($_POST['todoItem']);
        break;

     case "loadPage":
     onlyAdmin();
        $page = new WIPage();
        $page->LoadPage($_POST['page']);
        break;

    case "loadOptions":
    onlyAdmin();
        $page = new WIPage();
        $page->loadPageOptions($_POST['page']);
        break;

            case "changePage":
    onlyAdmin();
        $page = new WIPage();
        $page->LoadPage($_POST['page']);
        break;

    case "lsc_change":
    onlyAdmin();
        $page = new WIPage();
        $page->LoadPage($_POST['page'], $_POST['col']);
        break;

    case "togglelsc_change":
    onlyAdmin();
        $page = new WIPage();
        $page->toogleLsc($_POST['page'], $_POST['col']);
        break;

    case "rsc_change":
    onlyAdmin();
        $page = new WIPage();
        $page->LoadPage($_POST['page'], $_POST['col']);
        break;
        
    case "lsc_changed":
    onlyAdmin();
        $page = new WIPage();
        $page->changeLSC($_POST['page'], $_POST['col']);
        break;

    case "rsc_changed":
    onlyAdmin();
        $page = new WIPage();
        $page->changeRSC($_POST['page'], $_POST['col']);
        break;

    case "new_page":
    onlyAdmin();
        $page = new WIPage();
        $page->newPage($_POST['page'], $_POST['Value']);
        break; 

    case "pageList":
    onlyAdmin();
        $page = new WIPage();
        $page->PageListings();
        break;

    case "page_delete":
    onlyAdmin();
        $page = new WIPage();
        $page->deletePage($_POST['page_id'], $_POST['name']);
        break;

    case "changePic":
    onlyAdmin();
        $site = new WISite();
        $site->headerPic($_POST['img'], $_POST['header_content'], $_POST['button']);
        break;

    case "changefaviconPic":
    onlyAdmin();
        $site = new WISite();
        $site->faviconPic($_POST['img']);
        break;

    case "saveLang":
    onlyAdmin();
        $web = new WIWebsite();
        $web->saveLang($_POST['name'], $_POST['code'], $_POST['flag']);
        break;

    case "AddeditLang":
    onlyAdmin();
        $web = new WIWebsite();
        $web->saveeditLang($_POST['name'], $_POST['code'], $_POST['flag'], $_POST['id']);
        break;

    case "resfresh":
    onlyAdmin();
        $web = new WIWebsite();
        $web->viewLang();
        break;

    case "folder":
    onlyAdmin();
        $img = new WIImage();
        $img->Folder($_POST['folder']);
        break;

    case "back":
    onlyAdmin();
        $img = new WIImage();
        $img->AllPics();
        break;

    case "createMod":
    onlyAdmin();
        $mod = new WIModules();
        $mod->createMod($_POST['contents'], $_POST['mod_name'], $_POST['mod_drop'], $_POST['element']);
        break;

    case "EditMod":
    onlyAdmin();
        $mod = new WIModules();
        $mod->editContents($_POST['title'], $_POST['para'], $_POST['mod_name']);
        break;

    case "changeMetaPage":
    onlyAdmin();
        $page = new WIPage();
        $page->LoadMetaPage($_POST['page']);
        break;

    case "changeJsPage":
    onlyAdmin();
        $page = new WIPage();
        $page->LoadJsPage($_POST['page']);
        break;

    case "changeCssPage":
    onlyAdmin();
        $page = new WIPage();
        $page->LoadCssPage($_POST['page']);
        break;

    case "viewThemes":
    onlyAdmin();
        $web = new WIWebsite();
        $web->viewThemes();
        break;

    case "themeActivate":
    onlyAdmin();
        $web = new WIWebsite();
        $web->activateThemes($_POST['id']);
        break;

         case "themeDeactivate":
        $web = new WIWebsite();
        $web->deactivateThemes($_POST['id']);
        break;
        
        case "viewMeta":
    onlyAdmin();
        $web = new WIWebsite();
        $web->ViewMeta($_POST['page']);
        break;

    case "editMeta":
    onlyAdmin();
        $web = new WIWebsite();
        $web->ViewEditMeta($_POST['id']);
        break;

    case "editMetaDetails":
    onlyAdmin();
        $web = new WIWebsite();
        $web->EditMeta($_POST['id'], $_POST['name'], $_POST['content'], $_POST['auth']);
        break;

    case "DeleteMeta":
    onlyAdmin();
        $web = new WIWebsite();
        $web->DeleteMeta($_POST['id']);
        break;

    case "viewCss":
    onlyAdmin();
        $web = new WIWebsite();
        $web->ViewCSS($_POST['page']);
        break;

    case "editCss":
    onlyAdmin();
        $web = new WIWebsite();
        $web->ViewEditCss($_POST['id']);
        break;

    case "editCssDetails":
    onlyAdmin();
        $web = new WIWebsite();
        $web->EditCss($_POST['id'], $_POST['css']);
        break;

    case "deletecss":
    onlyAdmin();
        $web = new WIWebsite();
        $web->DeleteCss($_POST['id']);
        break;

    case "viewjs":
    onlyAdmin();
        $web = new WIWebsite();
        $web->ViewJS($_POST['page']);
        break;


    case "ViewEditJs":
    onlyAdmin();
        $web = new WIWebsite();
        $web->ViewEditJs($_POST['id']);
        break;

    case "editJsDetails":
    onlyAdmin();
        $web = new WIWebsite();
        $web->EditJs($_POST['id'], $_POST['js']);
        break;

    case "deleteJs":
    onlyAdmin();
        $web = new WIWebsite();
        $web->DeleteJs($_POST['id']);
        break;

    case "addNew":
    onlyAdmin();
        $topic = new WITopic();
        $topic->addNew();
        break;

    case "newTopic":
    onlyAdmin();
        $topic = new WITopic();
        $topic->newTopic($_POST['topic']);
        break;

    case "Topics":
    onlyAdmin();
        $topic = new WITopic();
        $topic->topic_Info();
        break;

    case "editTopics":
    onlyAdmin();
        $topic = new WITopic();
        $topic->editTopics($_POST['topic'], $_POST['id']);
        break;

    case "version_control":
    onlyAdmin();
        $site = new WISite();
        $site->VersionControl($_POST['version']);
        break;

        case "ChangePageViewLang":
    onlyAdmin();
        $web = new WIWebsite();
        $web->viewTrans($_POST['page']);
        break;

        case "install_plugin":
    onlyAdmin();
        $plug = new WIPlugin();
        $plug->Install($_POST['plug'], $_POST['plugin']);
        break;

        case "enable_plugin":
    onlyAdmin();
        $plug = new WIPlugin();
        $plug->Activate($_POST['Form'], $_POST['dir']);
        break; 

        case "showTheatres":
        $theatres = new WITheatres();
        $theatres->ShowAll();
        break; 

        case "add_person":
        $people = new WIPeople();
        $people->addPerson($_POST['name'], $_POST['bio'],$_POST['dob'], $_POST['img']);
        break; 

        case "newshowperson":
        $people = new WIPeople();
        $people->showInstalledPerson($_POST['PersonId']);
        break; 

        case "userRole":
        onlyAdmin();

        $admin = new WIAdmin(WISession::get('user_id'));
        echo json_encode($admin->getRole());
        break;

        case "actorRole":
        $actor  = new WIActor();
        $actor->SelectActorRole();
        break;

        case "findCast":
        $people  = new WIPeople();
        $people->findCast();
        break;

        case "showEditPeople":
        $people  = new WIPeople();
        $people->ViewEditPeople();
        break;

         case "editPerson":
        $people  = new WIPeople();
        $people->editPerson($_POST['id'], $_POST['name'], $_POST['bio'], $_POST['bcity'], $_POST['dob'],$_POST['img']);
        break;

        case "selectPerson":
        $people  = new WIPeople();
        $people->selectPerson($_POST['id']);
        break;

        case "addingCastPerson":
        $people  = new WIPeople();
        $people->addingCastPerson($_POST['id'], $_POST['character'],$_POST['actor_name'], $_POST['role']);
        break;

        case "addPerson":
        $people  = new WIPeople();
        $people->addPersonel($_POST['name'], $_POST['dob'],$_POST['bcity'], $_POST['bio'], $_POST['img']);
        break;

        case "deletePerson":
        $people  = new WIPeople();
        $people->deletePerson($_POST['id']);
        break;

        case "DeleteCharacter":
        $cast  = new WICast();
        $cast->deleteCastPerson($_POST['id']);
        break;

        case "SearchPerson":
        $people  = new WIPeople();
        $people->searchPerson($_POST['search']);
        break;

        case "SearchCompany":
        $company  = new WICompany();
        $company->searchCompany($_POST['search']);
        break;

        case "deleteCompany":
        $company  = new WICompany();
        $company->deleteCompany($_POST['id']);
        break;

        case "createCompany":
        $company  = new WICompany();
        $company->CreateCompany($_POST['name'], $_POST['address'],$_POST['country'], $_POST['bio'], $_POST['img']);
        break;

        case "showEditCompany":
        $company  = new WICompany();
        $company->ViewEditCompany();
        break;

         case "editCompany":
        $company  = new WICompany();
        $company->editCompany($_POST['id'], $_POST['name'], $_POST['bio'], $_POST['address'],$_POST['country'],$_POST['img']);
        break;

        case "SearchTheatre":
        $theatres  = new WITheatres();
        $theatres->searchTheatre($_POST['search']);
        break;

        case "deleteTheatre":
        $theatres  = new WITheatres();
        $theatres->deleteTheatre($_POST['id']);
        break;

        case "createTheatre":
        $theatres  = new WITheatres();
        $theatres->CreateTheatre($_POST['name'], $_POST['line1'], $_POST['line2'], $_POST['city'], $_POST['region'], $_POST['postcode'],$_POST['country'], $_POST['bio'], $_POST['img']);
        break;

        case "showEditTheatre":
        $theatres  = new WITheatres();
        $theatres->ViewEditTheatre();
        break;

         case "editTheatre":
        $theatres  = new WITheatres();
        $theatres->editTheatre($_POST['id'],$_POST['name'], $_POST['line1'], $_POST['line2'], $_POST['city'], $_POST['region'], $_POST['postcode'],$_POST['country'], $_POST['bio'], $_POST['img'], $_POST['da'], $_POST['dt'], $_POST['wc'], $_POST['bar'], $_POST['hearing'], $_POST['guide_dogs'], $_POST['stairs'], $_POST['disabled_parking']);
        break;

        case "SearchShows":
        $shows  = new WIShows();
        $shows->searchShows($_POST['search']);
        break;

        case "deleteShows":
        $shows  = new WIShows();
        $shows->deleteshow($_POST['id']);
        break;

        case "createShows":
        $shows  = new WIShows();
        $shows->CreateShows($_POST['name'], $_POST['theatre_name'], $_POST['theatre_location'], $_POST['theatre_id'], $_POST['company'], $_POST['company_id'],$_POST['start_date'],$_POST['end_date'], $_POST['bio'], $_POST['img']);
        break;

        case "showEditShows":
        $shows  = new WIShows();
        $shows->ViewEditShows();
        break;

         case "editShows":
        $shows  = new WIShows();
        $shows->editshow($_POST['id'],$_POST['name'],$_POST['bio'], $_POST['theatre'], $_POST['theatre_id'], $_POST['company'], $_POST['company_id'], $_POST['start_date'], $_POST['end_date'],  $_POST['img']);// $_POST['location'],
        break;

        case "findTheatres":
        $theatre  = new WITheatres();
        $theatre->GetTheatres($_POST['show_id']);
        break;

        case "editFindTheatres":
        $theatre  = new WITheatres();
        $theatre->editGetTheatres($_POST['id']);
        break;

        case "getTheatre_info":
        $theatre  = new WITheatres();
        $theatre->getTheatre_info($_POST['id']);
        break;

        case "editGetTheatre_info":
        $theatre  = new WITheatres();
        $theatre->editGetTheatre_info($_POST['id'], $_POST['show_id']);
        break;

        case "findCompany":
        $company  = new WICompany();
        $company->GetCompany();
        break;

        case "editFindCompany":
        $company  = new WICompany();
        $company->editGetCompany($_POST['id']);
        break;

        case "getCompany_info":
        $company  = new WICompany();
        $company->getCompany_info($_POST['id']);
        break;

        case "editGetCompany_info":
        $company  = new WICompany();
        $company->editGetCompany_info($_POST['company_id'], $_POST['id']);
        break;

        case "mediaPictures":
        $image  = new WIImage();
        $image->UploadedPics($_POST['selector'], $_POST['ele_id']);  //
        break;

        case "newPersonModal":
        $media  = new WIMedia();
        $media->NewMedia($_POST['ele_id'], $_POST['preview_class'], $_POST['preview_id']);
        break;

         case "MediaManager":
        $media  = new WIMedia();
        $media->MediaCenter($_POST['class_selector'], $_POST['folder'], $_POST['img_selector'], $_POST['photo_class'], $_POST['img_id_selector']);
        break;

         case "uploadMedia":
        $media  = new WIMedia();
        $media->UploadMedia($_POST['ele_id'], $_POST['table'], $_POST['folder'], $_POST['id_selector'], $_POST['img_selector']);
        break;

         case "uploadCSV":
        $media  = new WIMedia();
        $media->UploadCSV($_POST['table'], $_POST['ele_id'], $_POST['folder'], $_POST['id_selector'], $_POST['img_selector']);
        break;

        case "BulkUpload":
        $media  = new WIMedia();
        $media->BulkImageUpload($_POST['ele_id'], $_POST['folder'], $_POST['id_selector'], $_POST['img_selector']);
        break;

        case "installCSV":
        $WICSV  = new WICSV();
        $WICSV->Database($_POST['csv'], $_POST['table']);
        break;

        case "CreateFeatures":
        $features  = new WIFeatures();
        $features->InstallFeatures($_POST['ele_id'], $_POST['theatre_id']);
        break;

        case "InstallTheatreFeatures":
        $features  = new WIFeatures();
        $features->InstallTheatreFeatures($_POST['theatre_id'],$_POST['da'], $_POST['dt'], $_POST['wc'], $_POST['bar'], $_POST['hearing'], $_POST['guide_dogs'], $_POST['stairs'], $_POST['disabled_parking']);
        break;

        case "findShow":
        $shows  = new WIShows();
        $shows->FindShows();
        break;

        case "findCrewShow":
        $shows  = new WIShows();
        $shows->FindCrewShows();
        break;

        case "getShow_info":
        $shows  = new WIShows();
        $shows->getShow_info($_POST['id']);
        break;

        case "getCrewShow_info":
        $shows  = new WIShows();
        $shows->getCrewShow_info($_POST['id']);
        break;

        case "findCrew":
        $people  = new WIPeople();
        $people->findCrew();
        break;

        case "findActor":
        $people  = new WIPeople();
        $people->findCast();
        break;

        case "selectCastPerson":
        $people  = new WIPeople();
        $people->selectCastPerson($_POST['id']);
        break;

        case "selectCrewPerson":
        $people  = new WIPeople();
        $people->selectCrewPerson($_POST['id']);
        break;

        case "addingCastingPerson":
        $cast  = new WICast();
        $cast->addingCastPerson($_POST['show_id'],$_POST['show_name'], $_POST['charactor_name'],$_POST['actor_id'], $_POST['img'], $_POST['role']);
        break;

        case "addingCrewPerson":
        $crew  = new WICrew();
        $crew->addingCrewPerson($_POST['show_id'],$_POST['show_name'], $_POST['charactor_name'],$_POST['actor_id'], $_POST['img'], $_POST['role']);
        break;

        case "showEditCastingShows":
        $cast  = new WICast();
        $cast->ViewEditShowingCast();
        break;

        case "showEditCrewShows":
        $crew  = new WICrew();
        $crew->ViewEditShowingCrew();
        break;


        case "findPage":
        $page  = new WIPage();
        $page->findPage();
        break;

        case "findinDisplayActor":
        $media  = new WIMedia();
        $media->findActor($_POST['ele_id']);
        break;

        case "findinDisplayCastingActor":
        $media  = new WIMedia();
        $media->findCastingActor($_POST['ele_id'], $_POST['id'], $_POST['show_id']);
        break;

        case "selectCastedPerson":
        $people  = new WIPeople();
        $people->selectCastedPerson($_POST['id']);
        break;

        case "selectedEditingCastingPerson":
        $people  = new WIPeople();
        $people->selectEditCastedPerson($_POST['id'], $_POST['cast_id'], $_POST['show_id']);
        break;

        case "editCastingPerson":
        $cast  = new WICast();
        $cast->editCastingPerson($_POST['person_id'], $_POST['show_id'],$_POST['show_name'], $_POST['charactor_name'], $_POST['cast_id'], $_POST['actor_id'], $_POST['img'], $_POST['role']);
        break;

        case "createTrailer":
        $media  = new WIMedia();
        $media->UploadTrailerMedia($_POST['ele_id'], $_POST['table'], $_POST['folder'] , $_POST['id_selector'], $_POST['img_selector'], $_POST['show_id'], $_POST['theatre_id']);
        break;


        case "addTrailer":
        $show  = new WIShows();
        $show->addShowTrailer( $_POST['show_id'], $_POST['theatre_id'], $_POST['src']);
        break;

        case "EditCharacter":
        $cast  = new WICast();
        $cast->EditCharater( $_POST['id'], $_POST['charactor_name']);
        break;

        case "todoListDelete":
        $dashboard  = new WIDashboard();
        $dashboard->DeleteTodo( $_POST['id']);
        break;

        case "deleteTrailer":
        $shows  = new WIShows();
        $shows->deleteTrailer( $_POST['id']);
        break;

         case "permission_change":
        $site  = new WISite();
        $site->changePermissions( $_POST['id'], $_POST['column']);
        break;

         case "createPermission":
        $perm  = new WIPermissions();
        $perm->CreateNewPermission($_POST['role_id'], $_POST['role'], $_POST['permName'], $_POST['group']);
        break;

        case "groupPermission":
        $perm  = new WIPermissions();
        $perm->CreateGroupPermission($_POST['group']);
        break;

        case "edit_Page":
        $page  = new WIPage();
        $page->EditPage($_POST['data']);
        break;


        default:

        break;
}

$action = isset($_GET['action']) ? $_GET['action'] : null;
switch($action){
        
       case "todoList":
       onlyAdmin();
       $dashboard = new WIDashboard();
       $dashboard->toDoList() ;
       break;

       case "NextPagetodolist":
       $dashboard = new WIDashboard();
       $dashboard->toDoList($_POST['page']) ;
       break;

       case "NextPagenotifications":
       $dashboard = new WIDashboard();
       $dashboard->WINotifications($_POST['page']) ;
       break;

        case 'CheckChat':
        $chat->getChatMessages( $_GET['last_chat_time'], $_GET['userId']);
        break;
        
        
        case 'getChats':
            $response = Chat::getChats($_GET['lastID']);
        break;

        case "Notifications":
        onlyAdmin();
       $dashboard = new WIDashboard();
       $dashboard->Notifications() ;
       break;

       case "NotificationsList":
        onlyAdmin();
       $dashboard = new WIDashboard();
       $dashboard->WINotifications();
       break;

        case "registeredUsercount":
        onlyAdmin();
       $site = new WISite();
       $site->RegisteredUsers() ;
       break;

        case "NotificationsCount":
        onlyAdmin();
        $site = new WISite();
        $site->notifications_badge();
        break;

        case "MessagesCount":
        onlyAdmin();
        $site = new WISite();
        $site->MessageBagde();
        break;

         case "activeChatCount":
         onlyAdmin();
        $site = new WISite();
        $site->ActiveChatCount();
        break;


        case "TasksCount":
        onlyAdmin();
        $site = new WISite();
        $site->TaskBagde();
        break;

        case "info_box":
        $dash = new WIDashboard();
        $dash->Info_Boxes();
        break;

        case "getMessages":
        $contact = new WIContact();
        $contact->Messages();
        break;

        case "tasks":
        onlyAdmin();
        $site = new WISite();
        $site->tasks();
        break;

        case "load_mod":
        onlyAdmin();
        $mod = new WIModules();
        $mod->tasks();
        break;

        case "permissions":
        onlyAdmin();
        $perm = new WIPermissions();
        $perm->PermissionTabs();
        break;

        case "groupPerms":
        onlyAdmin();
        $perm = new WIPermissions();
        $perm->GroupPermissionTabs();
        break;
        
        default:
        break;
   }

function onlyAdmin() {
    $login = new WILogin();
    if ( ! $login->isLoggedIn() ) exit();

    $loggedUser = new WIAdmin(WISession::get("user_id"));
    if( ! $loggedUser->isAdmin() ) exit();
}