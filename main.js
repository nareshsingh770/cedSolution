$(document).ready(function () {
    if ($("#post-214")) {
        $("body").trigger("click");
        $(".eml label").addClass("active");
    }

    function addAlertModal() {
        var iframe = $("#alertmessage2_ifr");
        var editorContent = $("#tinymce[data-id=alertmessage2]", iframe.contents()).text().length;
        var title_length = $("#alertsubject").val().length;
        var end_date_length = $("#hiredate2").datepicker().val().length;

        if (editorContent == 0 || title_length == 0 || end_date_length == 0) {
            $("#addPost .alertSaveButton").addClass("disabled-button");
        } else {
            $("#addPost .alertSaveButton").removeClass("disabled-button");
        }
        //console.log('sshi')
    }



    $("#add2_cancel_btn .center button:last-child").click(function () {
        $('#add_postModal').modal('close');
        //$('#addPost .alertSaveButton').addClass('disabled-button disabledbtn'); 
    });
    $('div#noteModal .cancelButton').click(function () {
        setTimeout(() => {
            var ModalOverlay = $('.modal-overlay')
            console.log('opened ', ModalOverlay)
            ModalOverlay.each(function (ind) {
                debugger;
                if (ind === ModalOverlay.length - 1) {

                    $(this).css('z-index', '1102');
                    $('div#add_note_cancel').css('z-index', '1103');
                }

            })
        }, 200);
    })

    tinymce.init({
        selector: "textarea#alertmessage_backstage",
        height: "132",
        ui_container: "#add_postModal",
        content_style: "body {color: #969696;}",
        convert_urls: false,
        init_instance_callback: function (editor) {
            editor.on("keyup", function () {
                addAlertModal();
                //console.log('editor hbbh sshi')        
            });
            editor.on('ExecCommand', function (e) {
                addAlertModal();
            });
        }
    });


    $("#addPost").on("keyup", "#alertsubject", function () {
        addAlertModal();
    });

    //checkbox - Edit Post tinyEditor==============
    $("#addPost").on("change", ".custom_proxy_checkbox1", function () {
        addAlertModal();
    });




    $("div#back-stage #hiredate2").datepicker()

    // Menu dropdowns
    var menuParent = $(".avatarWrap");
    $(".nav-wrapper .avatarWrap .avatar").click(function (e) {
        menuParent.find(".avatarDropdown").toggleClass("active");
    });
    $("#alerts").click(function (e) {
        $(".alertsDropdown").toggleClass("active");
    });

    // Close on outside click
    // Does not use e.stopPropogation() and will not collide with other JS
    $(document).on("click", function (event) {
        if (!$(event.target).closest(".actionList.active").length) {
            actions.find(".actionList.active").removeClass("active");
            $("actions.clicked").removeClass("clicked");
        }
        if (!$(event.target).closest(".avatarWrap .avatar").length) {
            $(".avatarDropdown").removeClass("active");
        }
        if (!$(event.target).closest("#alerts").length) {
            $(".alertsDropdown").removeClass("active");
        }
        if (!$(event.target).closest(".actions.clicked").length) {
            $(".actions.clicked").removeClass("clicked");
        }
    });

    // Custom Select Logic
    $("select").material_select();
    var selectPointer = $(".islandContent label.selectLabel");
    selectPointer.click(function () {
        $(this)
            .siblings(".select-wrapper")
            .find(".select-dropdown")
            .trigger("click");
    });

    // Expand and Contract Content for Islands
    var islandRoot = $(".island");
    islandRoot.find(".collapser").click(function () {
        $(this).closest(".island").toggleClass("active");
        if ($(this).closest(".island").hasClass("expandAll")) {
            $(this).closest(".island").removeClass("expandAll");
            $(this).closest(".island").removeClass("active");
        }
    });

    islandRoot.find(".metricCollapser").click(function () {
        $(this).closest(".listItem").toggleClass("active");
        if ($(this).closest(".listItem").hasClass("expandAll")) {
            $(this).closest(".listItem").removeClass("expandAll");
            $(this).closest(".listItem").removeClass("active");
        }
    });

    // Expand All
    var expandAll = $(".filters .expand span").not(".options");
    var clickCount = 0;
    expandAll.click(function () {
        islandRoot.find($(".rightColumn .listItem")).removeClass("active");
        islandRoot.find($(".rightColumn .listItem")).toggleClass("expandAll");
        clickCount++;
        if (clickCount % 2 != 0) {
            $(this).text("Collapse All");
        } else {
            $(this).text("Expand All");
            islandRoot
                .find($(".rightColumn .listItem"))
                .removeClass("expandAll");
        }
    });

    // Select All Logic
    var selectAll = $(".filters .select .shareSelect");
    var selectCount = 0;
    selectAll.click(function () {
        selectCount++;
        islandRoot
            .find($(".rightColumn .listItem .shareSelect input"))
            .prop("checked", true);
        if (selectCount % 2 != 0) {
            $(this).text("Unselect All");
        } else {
            $(this).text("Select All");
            islandRoot
                .find($(".rightColumn .listItem .shareSelect input"))
                .prop("checked", false);
        }
    });

    // Close on outside click
    $("html").click(function () {
        $('.actions').find(".actionList.active").removeClass("active");
        $('.actions').removeClass("clicked");
        $('header .tintbg').hide();
        // $('.alertsDropdown').removeClass('active');
    });

    // VLT Upload Modals Config
    $("#uploadTrigger").modal({
        dismissible: true,
        startingTop: "20%",
        endingTop: "30%",
    });

    $("[id^=variableTrigger]").modal({
        dismissible: true,
        startingTop: "20%",
        endingTop: "30%",
    });

    $("#modaltci").modal({
        dismissible: true,
        startingTop: "20%",
        endingTop: "30%",
    });

    $(".modal123Action.modal-trigger").on("click", function () {
        $("#modal123").modal("open");
    });

    $("#modaltcipend").modal({
        dismissible: true,
        startingTop: "20%",
        endingTop: "30%",
    });

    // Move Modal
    $("#moveModal").modal({
        dismissible: true,
        startingTop: "20%",
        endingTop: "30%",
    });

    $(".moveAction.modal-trigger").on("click", function () {
        $("#moveModal").modal("open");
    });

    // Note Modal
    $("#noteModal").modal({
        dismissible: true,
        startingTop: "20%",
        endingTop: "30%",
    });
    $(".noteAction.modal-trigger").on("click", function () {
        $("#noteModal").modal("open");
    });

    // View Note Modal
    $("#viewNoteModal").modal({
        dismissible: true,
        startingTop: "20%",
        endingTop: "30%",
    });

    $(".viewNoteTrigger").on("click", function () {
        $("#viewNoteModal").modal("open");
        var scrollableArea = $("#viewNoteModal .noteContent .p1");
        scrollbarCheck(scrollableArea);
    });

    // Insurance Modal
    // Alerts Modal
    $("#insuranceModal").modal({
        dismissible: true,
        startingTop: "20%",
        endingTop: "30%",
    });

    $(
        "#modalInsuranceTrigger i, body#post-31774 .permissionApplyModal .controlWrapper .back-btn"
    ).on("click", function () {
        $("#insuranceModal").modal("open");
    });

    /*== permission Modal ==*/
    $("#insuranceModal2").modal({
        dismissible: true,
        startingTop: "20%",
        endingTop: "30%",
    });

    $(
        "#modalInsuranceTrigger2 i, body#post-35048 .permissionApplyModal .controlWrapper .back-btn, body#post-35703 .permissionApplyModal .controlWrapper .back-btn, .permissionApply_singleModal .controlWrapper .back-btn"
    ).on("click", function () {
        $("#insuranceModal2").modal("open");
    });

    /*== base-camp-profile-7 Modal ==*/
    $("#profileModal").modal({
        dismissible: true,
        startingTop: "20%",
        endingTop: "30%",
    });

    $("#profileModalbtn").on("click", function () {
        $("#profileModal").modal("open");
    });

    /*== base-camp-profile-3 Modal ==*/
    $("body#post-32012 #insuranceModal button.orangeButton").on(
        "click",
        function () {
            $("#permissionApply_singleModal").modal("open");
        }
    );
    $("body#post-32012 #permissionApplyModal .controlWrapper .back-btn").on(
        "click",
        function () {
            $("#permissionApply_singleModal").modal("open");
            $("#insuranceModal").modal("close");
        }
    );
    /*== base-camp-profile-6 Modal ==*/
    $("body#post-32027 #permissionApplyModal button.orangeButton").on(
        "click",
        function () {
            $("#permissionApply_singleModal").modal("open");
            $("#insuranceModal").modal("close");
        }
    );
    $(
        "body#post-32027 #permissionApply_singleModal .controlWrapper .back-btn"
    ).on("click", function () {
        $("#permissionApplyModal").modal("open");
        $("#insuranceModal").modal("close");
    });
    $("body#post-32027 #permissionApply_singleModal button.orangeButton").on(
        "click",
        function () {
            $("#permissionApplyModal").modal("close");
        }
    );
    /*===================================================== Custom Permission Modal page start =======================================================*/
    /*==== admin-modals section =====*/
    $("#custom_insuranceModal2").modal({
        dismissible: true,
        startingTop: "20%",
        endingTop: "30%",
    });
    $(
        "#1_manager,#2_admin,#3_owner, .button_3 .custom_modal_btn3, #custom_permissionApplyModal .back-btn, #add_employee i"
    ).on("click", function () {
        $("#custom_insuranceModal2").modal("open");
    });

    /*== warning Modal ==*/
    $("#custom_warningModal").modal({
        dismissible: true,
        startingTop: "20%",
        endingTop: "30%",
    });

    $("#custom_insuranceModal2 #orangeButton").on("click", function () {
        $("#custom_warningModal").modal("open");
    });

    /*== permission Apply Modal ==*/
    $("#custom_permissionApplyModal").modal({
        dismissible: true,
        startingTop: "20%",
        endingTop: "30%",
    });

    $(
        "#custom_warningModal .orangeButton, #custom_lastpermissionApplyModal .back-btn, #custom_insuranceModal2 #employee_orangeButton, #proxy_error_Modal .orangeButton, #admin_proxy_no_orangeButton"
    ).on("click", function () {
        $("#custom_permissionApplyModal").modal("open");
    });

    /*== last permission Apply Modal ==*/
    $("#custom_lastpermissionApplyModal").modal({
        dismissible: true,
        startingTop: "20%",
        endingTop: "30%",
    });

    $(
        "#custom_permissionApplyModal button.manager_level2, #custom_permissionApplyModal button.admin_level2"
    ).on("click", function () {
        $("#custom_lastpermissionApplyModal").modal("open");
    });

    /*== proxy error Modal ==*/
    //1) Vertical & Horizontal. Level not sticking for Admin/Admin Proxy, add Admin Proxy option.  https://www.screencast.com/t/pyE4X6jAqVu
    $("#proxy_error_Modal, #fourOption_proxy_error_Modal").modal({
        dismissible: true,
        startingTop: "20%",
        endingTop: "30%",
    });

    /*$("#admin_proxy_orangeButton").on("click", function () {
        $("#proxy_error_Modal").modal("open");
    });*/

    /*========== cudtom 4 button modals ======================*/
    /*==== admin-modals section =====*/
    $("#four_custom_insuranceModal2").modal({
        dismissible: true,
        startingTop: "20%",
        endingTop: "30%",
    });
    $(
        ".custom_modal_btn2, #four_custom_permissionApplyModal .back-btn, #employee_modal i"
    ).on("click", function () {
        $("#four_custom_insuranceModal2").modal("open");
    });

    /*== warning Modal ==*/
    $("#four_custom_warningModal, #profile_change_custom_warningModal").modal({
        dismissible: true,
        startingTop: "20%",
        endingTop: "30%",
    });

    $(
        "#four_custom_insuranceModal2 #orangeButton, #admin_four_proxy_no_orangeButton").on("click", function () {
            $("#four_custom_warningModal").modal("open");
        });

    //if "Manager" selected by default then skip warning modal of Manager
    $("#four_custom_insuranceModal2 #orangeButton").on("click", function () {
        var permission_text = $("body#post-35703 .permissions-section .employee_level p").text();
        if (permission_text == "Manager") {
            $("#four_custom_warningModal").modal("close");
            $("#four_custom_permissionApplyModal").modal("open");
        }
    });

    //if "Manager" selected by default then skip warning modal of Manager == Seprate New Page -> Edit Manager Without Proxy #34623
    $("#four_custom_insuranceModal2 #orangeButton").on("click", function () {
        //var permission_text = ;
        if ($(".permission-heading").hasClass("edit_manager_without_proxy")) {
            $("#four_custom_warningModal").modal("close");
            $("#four_custom_permissionApplyModal").modal("open");
        }
    });

    //if profile 3 & 4 is selected then skip warning modal of proxy "No"
    $("#admin_four_proxy_no_orangeButton").on("click", function () {
        // if (localStorage.getItem("profileSelected") == "3_4") {
        //     console.log("3 ya 4 selected ");
        //     $("#four_custom_warningModal").modal("close");
        //     $("#four_custom_insuranceModal2").modal("close");
        //     $("#four_custom_permissionApplyModal").modal("open");
        // }

        if ($("body#post-35703 .permissions-section .employee_level p").text() == "Admin" && !$("body#post-35703 .permissions-section .employee_level p").hasClass("yes_proxy_text")) {
            console.log("3 ya 4 selected ");
            $("#four_custom_warningModal").modal("close");
            $("#four_custom_insuranceModal2").modal("close");
            $("#four_custom_permissionApplyModal").modal("open");

        } else {
            console.log("3 ya 4 selected ");
            $("#four_custom_warningModal").modal("open");
            $("#four_custom_permissionApplyModal").modal("close");
        }


        // var permission_text = $('body#post-35703 .permissions-section .employee_level p').text();
        // if(permission_text == "Manager"){
        //      $('#four_custom_warningModal').modal('open');
        //      $('#four_custom_permissionApplyModal').modal('close');
        // }
    });

    //if "Admin" selected by default then skip warning modal of Admin == Seprate New Page -> Edit Admin Without Proxy #34632
    // $("#admin_four_proxy_no_orangeButton").on("click", function () {
    //     //var permission_text = ;
    //     if ($(".permission-heading").hasClass("edit_admin_without_proxy")) {
    //         $("#four_custom_warningModal").modal("close");
    //         $("#four_custom_permissionApplyModal").modal("open");
    //     }
    // });

    /*== permission Apply Modal ==*/
    $("#four_custom_permissionApplyModal").modal({
        dismissible: true,
        startingTop: "20%",
        endingTop: "30%",
    });

    $(
        "#four_custom_warningModal .orangeButton, #four_custom_lastpermissionApplyModal .back-btn, #four_custom_insuranceModal2 #employee_orangeButton, #four_proxy_error_Modal .orangeButton"
    ).on("click", function () {
        $("#four_custom_permissionApplyModal").modal("open");
    });

    // Level Warning not working when you change Manager to Employee or Admin to Employee
    $("#four_custom_insuranceModal2 #employee_orangeButton").on(
        "click",
        function () {
            var bottom_permission_level_text = $(
                "body#post-35703 .permissions-section .employee_level p"
            ).text();
            switch (bottom_permission_level_text) {
                case "Employee":
                    $("#four_custom_warningModal").modal("close");
                    $("#four_custom_permissionApplyModal").modal("open");
                    break;
                case "Manager":
                case "Admin":
                    $("#four_custom_warningModal").modal("open");
                    $("#four_custom_permissionApplyModal").modal("close");
                    break;
            }
        }
    );

    //if "Manager" selected by default then skip warning modal of Manager == Seprate New Page -> Edit Manager Without Proxy #34623
    $("#four_custom_insuranceModal2 #employee_orangeButton").on(
        "click",
        function () {
            //var permission_text = ;
            if (
                $(".permission-heading").hasClass(
                    "edit_manager_without_proxy"
                ) ||
                $(".permission-heading").hasClass("edit_admin_without_proxy")
            ) {
                $("#four_custom_warningModal").modal("open");
                $("#four_custom_permissionApplyModal").modal("close");
            }
        }
    );

    /*== last permission Apply Modal ==*/
    $("#four_custom_lastpermissionApplyModal").modal({
        dismissible: true,
        startingTop: "20%",
        endingTop: "30%",
    });

    $(
        "#four_custom_permissionApplyModal button.manager_level2, #four_custom_permissionApplyModal button.admin_level2"
    ).on("click", function () {
        $("#four_custom_lastpermissionApplyModal").modal("open");
    });

    /*== proxy error Modal ==*/
    $("#four_proxy_error_Modal").modal({
        dismissible: true,
        startingTop: "20%",
        endingTop: "30%",
    });

    $("#admin_four_proxy_orangeButton").on("click", function () {
        $("#four_proxy_error_Modal").modal("open");
    });

    //if profile 6 is selected then skip warning modal of proxy "Yes"
    $("#admin_four_proxy_orangeButton").on("click", function () {
        if (
            localStorage.getItem("profileSelected") == "6" ||
            $(
                "body#post-35703 .permissions-section .employee_level p"
            ).hasClass("yes_proxy_text")
        ) {
            console.log("6 selected ");
            $("#four_proxy_error_Modal").modal("close");
            $("#four_custom_permissionApplyModal").modal("open");
        }
    });

    /*========================= owner last button modals ====================================*/
    /*==== admin-modals section =====*/
    $("#owner_four_custom_insuranceModal2").modal({
        dismissible: true,
        startingTop: "20%",
        endingTop: "30%",
    });
    $(
        ".owner_custom_modal, #owner_four_custom_permissionApplyModal .back-btn"
    ).on("click", function () {
        $("#owner_four_custom_insuranceModal2").modal("open");
    });

    /*== warning Modal ==*/
    $("#owner_four_custom_warningModal").modal({
        dismissible: true,
        startingTop: "20%",
        endingTop: "30%",
    });

    $("#owner_four_custom_insuranceModal2 #orangeButton").on(
        "click",
        function () {
            $("#owner_four_custom_warningModal").modal("open");
        }
    );

    /*== permission Apply Modal ==*/
    $("#owner_four_custom_permissionApplyModal").modal({
        dismissible: true,
        startingTop: "20%",
        endingTop: "30%",
    });

    $(
        "#owner_four_custom_warningModal .orangeButton, #owner_four_custom_lastpermissionApplyModal .back-btn, #owner_four_custom_insuranceModal2 #employee_orangeButton, #owner_four_proxy_error_Modal .orangeButton"
    ).on("click", function () {
        $("#owner_four_custom_permissionApplyModal").modal("open");
    });

    /*== last permission Apply Modal ==*/
    $("#owner_four_custom_lastpermissionApplyModal").modal({
        dismissible: true,
        startingTop: "20%",
        endingTop: "30%",
    });

    $(
        "#owner_four_custom_permissionApplyModal button.manager_level2, #owner_four_custom_permissionApplyModal button.admin_level2"
    ).on("click", function () {
        $("#owner_four_custom_lastpermissionApplyModal").modal("open");
    });


    $('#four_custom_insuranceModal2 .orangeButton').click(function () {

        var levelMain = $("body#post-35703 .permissions-section .employee_level p").text();

        var changedLevel = $('select#roleLevelSelect option:selected').text();
        // need to improve
        /*if(levelMain===changedLevel){
            $("#four_custom_warningModal").modal("close");      
        }*/
        /*$("#four_custom_permissionApplyModal").modal("open");*/

    })

    /*== proxy error Modal ==*/
    // $('#owner_four_proxy_error_Modal').modal({
    //     dismissible: true,
    //     startingTop: '20%',
    //     endingTop: '30%'
    // });

    // $('#admin_four_proxy_orangeButton').on('click', function() {
    //   $('#owner_four_proxy_error_Modal').modal('open');
    // });

    /*===================================================== Custom Permission Modal page end =======================================================*/

    /*======================= additional modals - 9/feb/2021 start ======================*/

    /*============ add-post modal ============*/
    $(".add_post_btn").click(function () {
        $("#addPost").modal("open");
        $("#addPost").scrollTop(0);
    });

    $("#add_cancel_btn .center button:last-child").click(function () {
        $("#addPost").modal("close");
        $("#addPost .alertSaveButton").addClass("disabled-button disabledbtn");
    });

    $(document).on("click", ".addalert .add_post_btn", function () {
        $("#addPost input#pinTop, #addPost input#notifyEmail").prop(
            "checked",
            false
        );
    });

    $("#addPost .controlWrapper").click(function () {
        $("#add_cancel_btn p").empty();
        $("#add_cancel_btn p").text("Your post has not been saved.");
    });

    $("#addPost .controlWrapper.controlWrapper-edit").click(function () {
        $("#add_cancel_btn p").empty();
        $("#add_cancel_btn p").text(
            "Any changes you have made will not be saved."
        );
    });

    //Pin post to top - checkbox onchange
    $("#addPost input#pinTop").on("change", function () {
        $(this).prop("checked")
            ? localStorage.setItem("PinToTop", true)
            : localStorage.removeItem("PinToTop");

        if ($(this).prop("checked")) {
            $("#add_cancel_btn .center button:last-child").click(function () {
                $("#addPost input#pinTop").prop("checked", false);
                localStorage.removeItem("PinToTop");
            });
        } else {
            $("#add_cancel_btn .center button:last-child").click(function () {
                $("#addPost input#pinTop").prop("checked", true);
                localStorage.setItem("PinToTop", true);
            });
        }
    });
    localStorage.getItem("PinToTop")
        ? $("#addPost input#pinTop").prop("checked", true)
        : $("#addPost input#pinTop").prop("checked", false);

    //Notify employees via email? - checkbox onchange
    $("#addPost input#notifyEmail").on("change", function () {
        $(this).prop("checked")
            ? localStorage.setItem("notifyEmployee", true)
            : localStorage.removeItem("notifyEmployee");

        if ($(this).prop("checked")) {
            $("#add_cancel_btn .center button:last-child").click(function () {
                $("#addPost input#notifyEmail").prop("checked", false);
                localStorage.removeItem("notifyEmployee");
            });
        } else {
            $("#add_cancel_btn .center button:last-child").click(function () {
                $("#addPost input#notifyEmail").prop("checked", true);
                localStorage.setItem("notifyEmployee", true);
            });
        }
    });
    localStorage.getItem("notifyEmployee")
        ? $("#addPost input#notifyEmail").prop("checked", true)
        : $("#addPost input#notifyEmail").prop("checked", false);

    // $(document).on('change', '#addPost input#notifyEmail', function(){

    // });

    /*============ contact us modal ============*/
    $(".contact_btn").click(function () {
        $("#contactUs").modal("open");
    });
    $("#contactus_cancel .center a:last-child").click(function () {
        $("#contactUs").modal("close");
        $("#contactUs").scrollTop(0);
    });
    function contactModalContent() {
        var contact_subject_length = $("#contactUs #contact_subject").val()
            .length;
        var contact_message_length = $("#contactUs #contact_message").val()
            .length;

        if (contact_subject_length == 0 || contact_message_length == 0) {
            $("#contactUs .orangeButton").addClass("disabled-button");
        } else {
            $("#contactUs .orangeButton").removeClass("disabled-button");
        }
    }
    $("#contactUs #contact_subject, #contactUs #contact_message").on(
        "keyup",
        function () {
            contactModalContent();
        }
    );

    /*============ feedback modal ============*/
    $(".feedback_btn").click(function () {
        $("#feedback").modal("open");
        $("#feedback").scrollTop(0);
    });
    $("#feed_cancel .center a:last-child").click(function () {
        $("#feedback").modal("close");
        $("#feedback").modal("close");
    });

    function feedbackModalContent() {
        var feedback_subject_length = $("#feedback #feedback_subject").val()
            .length;
        var feedback_message_length = $("#feedback #feedback_message").val()
            .length;

        if (feedback_subject_length == 0 || feedback_message_length == 0) {
            $("#feedback .orangeButton").addClass("disabled-button");
        } else {
            $("#feedback .orangeButton").removeClass("disabled-button");
        }
    }
    $("#feedback #feedback_subject, #feedback #feedback_message").on(
        "keyup",
        function () {
            feedbackModalContent();
        }
    );

    /*======================= additional modals - 9/feb/2021 end ======================*/

    /*== warning Modal ==*/
    $("#warningModal").modal({
        dismissible: true,
        startingTop: "20%",
        endingTop: "30%",
    });

    $(".permissionModal .orangeButton").on("click", function () {
        $("#warningModal").modal("open");
    });

    /*== permission Apply Modal ==*/
    $("#permissionApplyModal").modal({
        dismissible: true,
        startingTop: "20%",
        endingTop: "30%",
    });

    $(
        ".warningModal .orangeButton, #permissionApply_singleModal button.orangeButton"
    ).on("click", function () {
        $("#permissionApplyModal").modal("open");
    });

    /*== permission Apply single Modal ==*/
    $("#permissionApply_singleModal").modal({
        dismissible: true,
        startingTop: "20%",
        endingTop: "30%",
    });

    /*== base-camp-profile - cancel modal ==*/
    $("#cancel_modal").modal({
        dismissible: true,
        startingTop: "20%",
        endingTop: "30%",
    });

    $("#cancelModalbtn").on("click", function () {
        $("#cancel_modal").modal("open");
    });

    // Alerts Modal
    $("#modalAlert").modal({
        dismissible: true,
        startingTop: "20%",
        endingTop: "30%",
    });

    $(".modalAlertTrigger").on("click", function () {
        var numPeople;
        var dataCount = $(this).data("count");
        if (dataCount == 1) {
            numPeople = "1 person.";
        } else {
            numPeople = dataCount + " people.";
        }
        $(".alertShareCount").html(numPeople);
        $("#modalAlert").modal("open");
    });

    $("#deleteTrigger").modal({
        dismissible: true,
        startingTop: "20%",
        endingTop: "30%",
    });

    function scrollbarCheck(node) {
        var nodeHeight = node.height();
        var nodeOverflowHeight = node.get(0).scrollHeight;

        if (nodeOverflowHeight > nodeHeight) {
            node.addClass("hasScrollbar");
        }
    }

    // Tab Logic
    var tabbedViewParent = $(".tabbedView");
    tabbedViewParent
        .find(".titleWrapper")
        .not($(".uploadButton"))
        .click(function () {
            tabbedViewParent
                .find(".titleWrapper.activeTab")
                .removeClass("activeTab");
            $(this).addClass("activeTab");

            // Testing re-init of island expand all logic
            var islandRoot = $(".island");

            // Expand All
            var expandAll = $(".filters .expand span").not(".options");
            var clickCount = 0;
            expandAll.click(function () {
                islandRoot
                    .find($(".rightColumn .listItem"))
                    .removeClass("active");
                islandRoot
                    .find($(".rightColumn .listItem"))
                    .toggleClass("expandAll");

                clickCount++;
                if (clickCount % 2 != 0) {
                    $(this).text("Collapse All");
                } else {
                    $(this).text("Expand All");
                    islandRoot
                        .find($(".rightColumn .listItem"))
                        .removeClass("expandAll");
                }
            });
        });

    // Actions
    var actions = $(".dots");
    actions.click(function (e) {
        e.stopPropagation();
        if ($(this).parent().hasClass("clicked")) {
            $(this).parent().removeClass("clicked");
            $(".active.actionList").removeClass("active");
        } else {
            $(".active.actionList").removeClass("active");
            $(this).parent().find(".actionList").toggleClass("active");
            $(this).parent().addClass("clicked");
        }
    });

    // efolder actions
    var efolderAction = $(".eeAction  .dots");
    efolderAction.click(function () {
        $(".eeAction .eeActionList").toggleClass("active");
    });

    // $(".actionList li").click(function (e) {
    //     e.stopPropagation();
    //     $(".actionList.active").removeClass("active");
    // });

    // Phone Number formatting
    $("#cPhone, #hPhone, #ecp").on("keyup", function (e) {
        var phoneNumber = $(this);
        var charCode = e.which ? e.which : e.keyCode;
        phoneNumber.value = phoneFormat(phoneNumber.val());
        $(this).val(phoneNumber.value);
    });

    // New help overlay banner
    $("span.help-fa.closebtn").on("click", function () {
        $(".help-header").addClass("hidden");
    });

    // Help Overlay Toggle
    $("#overlayTrigger").click(function () {
        $(".helpOverlay").addClass("visible");
    });
    $(".helpOverlay").click(function () {
        $(".helpOverlay").removeClass("visible");
    });

    if ($('.input-field input[type="password"]').val() == "") {
        $(this).find("label").removeClass("active");
    }

    // File Snapshot Highlighting in /mfile
    var snapshotItems = $(".mfileMetrics .snapshotItems");
    $(".mfile .titleWrapper.shareTab").click(function () {
        snapshotItems.find(".bolderGreen").removeClass("bolderGreen");
        snapshotItems.find(".shareMetric").addClass("bolderGreen");
    });

    $(".mfile .titleWrapper.unshareTab").click(function () {
        snapshotItems.find(".bolderGreen").removeClass("bolderGreen");
        snapshotItems.find(".unshareMetric").addClass("bolderGreen");
    });

    $(".mfile .titleWrapper.signedTab").click(function () {
        snapshotItems.find(".bolderGreen").removeClass("bolderGreen");
        snapshotItems.find(".signedMetric").addClass("bolderGreen");
    });

    $(".mfile .titleWrapper.remindTab").click(function () {
        snapshotItems.find(".bolderGreen").removeClass("bolderGreen");
        snapshotItems.find(".remindMetric").addClass("bolderGreen");
    });

    $(".mfileMetrics .snapshotItems .shareMetric").click(function () {
        $(".mfile .titleWrapper.shareTab").trigger("click");
    });
    $(".mfileMetrics .snapshotItems .unshareMetric").click(function () {
        $(".mfile .titleWrapper.unshareTab").trigger("click");
    });
    $(".mfileMetrics .snapshotItems .signedMetric").click(function () {
        $(".mfile .titleWrapper.signedTab").trigger("click");
    });
    $(".mfileMetrics .snapshotItems .remindMetric").click(function () {
        $(".mfile .titleWrapper.remindTab").trigger("click");
    });

    //Modal disabled button logic (not pertaining to Upload)
    $("#moveModal select").on("change", function () {
        if ($(this).val() != 99) {
            $("#moveModal button.orangeButton").removeClass("disabled");
            $("#moveModal button.orangeButton").prop("disabled", false);
        }
    });

    if ($(".native").is(":visible")) {
        $(".hipaaLink").addClass("withNative");
    }

    $(".native").on("click", function () {
        if ($(".native").is(":hidden")) {
            $(".hipaaLink").removeClass("withNative");
        }
    });

    //==================================== permission modal email =======================================//
    //Add Employee - first four fields disabled button for MOBILE, IPAD & IPAD PRO
    if ($(window).width() < 1368) {
        //Add Employee - first four fields disabled button for MOBILE, IPAD & IPAD PRO - when SHORTER view
        function addEmpFourFields_shortView() {
            var addEmp_fname_length = $("body#post-35048 #fname").val().length;
            var addEmp_lname_length = $("body#post-35048 #lname").val().length;
            var addEmp_email_val = $("body#post-35048 #workEmail").val();
            var addEmp_email_pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{3,4}\b$/i;
            var addEmp_email_pattern_match = !addEmp_email_val || !addEmp_email_pattern.test(addEmp_email_val);
            var addEmp_level = $("#designation_level option:selected").val();

            if (addEmp_fname_length == 0 || addEmp_lname_length == 0 || addEmp_email_pattern_match || addEmp_level == "chooseone") {
                $("body#post-35048 .controlWrapper button.add_employee_btn.orangeButton").addClass("disabled-button");

            } else if (addEmp_fname_length == 0 || addEmp_lname_length == 0 || addEmp_email_pattern_match || addEmp_level !== "admin") {
                $("body#post-35048 .controlWrapper button.add_employee_btn.orangeButton").removeClass("disabled-button");

            } else if ($('.fourOption_proxy_error_Modal_info > .proxy-info .default_custom_proxy_checkbox1') || $('.fourOption_proxy_error_Modal_info > .proxy-info .default_custom_proxy_checkbox2')) {
                $("body#post-35048 .controlWrapper button.add_employee_btn.orangeButton").removeClass("disabled-button");
            }
        }

        //Add Employee - when level change - shorter view

        $("#designation_level").on("change", function () {
            var designation_name = $(this).find('option:selected').val();

            switch (designation_name) {
                case "employee":
                case "manager":
                    addEmpFourFields_shortView();
                    break;

                case "admin":
                    //$("body#post-35048 .controlWrapper button.add_employee_btn.orangeButton").addClass("disabled-button");
                    addEmpFourFields_shortView();
                    break;
            }

        });

        $('.fourOption_proxy_error_Modal_info > .proxy-info .proxy_checkbox').on('change', function () {

            var addEmp_fname_length = $("body#post-35048 #fname").val().length;
            var addEmp_lname_length = $("body#post-35048 #lname").val().length;
            var addEmp_email_val = $("body#post-35048 #workEmail").val();
            var addEmp_email_pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{3,4}\b$/i;
            var addEmp_email_pattern_match = addEmp_email_pattern.test(addEmp_email_val);

            if (addEmp_fname_length !== 0 && addEmp_lname_length !== 0 && addEmp_email_pattern_match) {
                $("body#post-35048 .controlWrapper button.add_employee_btn.orangeButton").removeClass("disabled-button");
            }

        });


        //Add Employee - first four fields disabled button for MOBILE, IPAD & IPAD PRO - when ADVANCED view
        function addEmpFourFields_advanceView() {
            var addEmp_fname_length = $("body#post-35048 #fname").val().length;
            var addEmp_lname_length = $("body#post-35048 #lname").val().length;
            var addEmp_email_val = $("body#post-35048 #workEmail").val();
            var addEmp_email_pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{3,4}\b$/i;
            var addEmp_email_pattern_match = !addEmp_email_val || !addEmp_email_pattern.test(addEmp_email_val);
            var addEmp_level = $("body#post-35048 .employee_level p").text();

            if (addEmp_fname_length == 0 || addEmp_lname_length == 0 || addEmp_email_pattern_match || addEmp_level == "Level not specified") {
                $("body#post-35048 .controlWrapper button.add_employee_btn.orangeButton").addClass("disabled-button");
            } else {
                $("body#post-35048 .controlWrapper button.add_employee_btn.orangeButton").removeClass("disabled-button");
            }
        }

        //Add Employee - when permission modal change - longer view
        $(document).on("click", "body#post-35048 .permission-done-btn", function () {
            addEmpFourFields_advanceView();
        }
        );

        $("body#post-35048 #fname, body#post-35048 #lname, body#post-35048 #workEmail").on("keyup", function () {
            if ($("body#post-35048 main .for_mobile.orangeButton").text() == "View Advanced") {
                addEmpFourFields_shortView();
            } else {
                addEmpFourFields_advanceView();
            }
        });

        //carry the level selection to view advanced
        $(".only_permission_level select#designation_level").change(function () {
            var permission_select_level = $(this).find("option:selected").text();
            $("body#post-35048 .permissions-section .employee_level p").text(permission_select_level);
        }
        );
    }

    //Add Employee - first four fields disabled button for DESKTOP
    else {
        function addEmpFourFields() {
            var addEmp_fname_length = $("body#post-35048 #fname").val().length;
            var addEmp_lname_length = $("body#post-35048 #lname").val().length;
            var addEmp_email_val = $("body#post-35048 #workEmail").val();
            var addEmp_email_pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;
            var addEmp_email_pattern_match =
                !addEmp_email_val ||
                !addEmp_email_pattern.test(addEmp_email_val);
            var addEmp_level = $("body#post-35048 .employee_level p").text();

            //console.log(addEmp_level)

            if (addEmp_fname_length == 0 || addEmp_lname_length == 0 || addEmp_email_pattern_match || addEmp_level == "Level not specified") {
                $("body#post-35048 .controlWrapper button.add_employee_btn.orangeButton").addClass("disabled-button");
            } else {
                $("body#post-35048 .controlWrapper button.add_employee_btn.orangeButton").removeClass("disabled-button");
            }
        }

        $("body#post-35048 #fname, body#post-35048 #lname, body#post-35048 #workEmail").on("keyup", function () {
            addEmpFourFields();
        });

        $(document).on("click", "body#post-35048 .permission-done-btn", function () {
            addEmpFourFields();
        }
        );
    }

    //Add Employee - permission modal = "choose one" selected if click on cancel button
    $("body#post-35048 .beneButton#add_employee").click(function () {
        //remove straight line from record/pay
        $("#nameRecords1, #namepay1").removeClass("straight-line");
        var permission_text = $(
            "body#post-35048 .permissions-section .employee_level p"
        ).text();
        if (permission_text == "Level not specified") {
            $("#custom_insuranceModal2 select").prop("selectedIndex", 0);
            $("#custom_insuranceModal2 .orangeButton").addClass("disabled-button");
            $("#admin-modals .proxy-info").hide();
        }
    });
    ////yueeee
    //clear selection when click on cancel button & again open modal on DESKTOP
    // $('body#post-35048 a.cancelButton[name="buttonchoice"]').click(function () {
    //     $("input.sub-checkbox2, input.main-checkbox2").prop("checked", false);
    // });

    //Add Employee - permission modal = Reset at the top
    $("body#post-35048 .permissionApplyModal .controlWrapper a.cancelButton.cedr-darkgray-font.modal-close.back-btn, body#post-35048 .controlWrapper button.orangeButton"
    ).click(function () {
        $("#per_scroll, #pre_scoll1, #custom_permissionApplyModal, #custom_lastpermissionApplyModal").scrollTop(0);
    });

    $("body#post-35703 .permissionApplyModal .controlWrapper a.cancelButton.cedr-darkgray-font.modal-close.back-btn, body#post-35703 .controlWrapper button.orangeButton"
    ).click(function () {
        $("#per_scroll, #pre_scoll1, #four_custom_permissionApplyModal, #four_custom_lastpermissionApplyModal").scrollTop(0);
    });

    //Add Employee - permission modal = clear storage when select other level from Admin
    localStorage.clear();
});
