$(function () {

    $("input").focus(function () {
        $(this).attr("dataval", $(this).attr("placeholder"));
        $(this).attr("placeholder", "");
    });

    $("input").blur(function () {
        $(this).attr("placeholder", $(this).attr("dataval"));
    });


    $("#sendmessage").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            method: 'POST',
            url: "result.php",
            contentType: false,
            processData: false,
            data: new FormData(this),
            success: function () {
                $("#sendmessage")[0].reset();
            }
        });
    });

    $("#serachmember").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            method: 'POST',
            url: "result.php",
            contentType: false,
            processData: false,
            data: new FormData(this),
            success: function (data) {
                $("#serachmember")[0].reset();
                $("#ser").html(data);
            }
        });
    });

    $(".checkjs").focus(function () {
        $(".allfriends").css({
            display: 'none',
        })
    });

    $(".checkjs").blur(function () {
        if ($(".checkjs").val() == " ") {
            $(".allfriends").css({
                display: 'none',
            })
        } else {
            $(".allfriends").css({
                display: 'block',
            })
        }
    });


    $("#editpersonle").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            method: 'POST',
            url: "result.php",
            contentType: false,
            processData: false,
            data: new FormData(this),
            success: function (data) {
                $("#editpersonle")[0].reset();
                $("#message").html(data);
            }
        });
    });

    $("#forgotten").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            method: 'POST',
            url: "result.php",
            contentType: false,
            processData: false,
            data: new FormData(this),
            success: function (data) {
                $("#forgotten")[0].reset();
                $("#forgott").html(data);
            }
        });
    });

    $(".buttonpass").click(function(){
        $(".passwordinfo").fadeIn(600);
        $(".crross").fadeIn(600);
        $(".crross").addClass("fa-spin");
    });

    $(".crross").click(function(){
        $(".passwordinfo").hide(600);
        $(this).hide(600);
    });

    $("#changepass").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            method: 'POST',
            url: "result.php",
            contentType: false,
            processData: false,
            data: new FormData(this),
            success: function (data) {
                $("#changepass")[0].reset();
                $("#mesgpass").html(data);
            }
        });
    });

    
    $("#imageuser").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            method: 'POST',
            url: "result.php",
            contentType: false,
            processData: false,
            data: new FormData(this),
            success: function (data) {
                $("#imageuser")[0].reset();
                $("#mesagephoto").html(data);
            }
        });
    });

});