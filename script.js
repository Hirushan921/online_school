$(function() {
    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });
})



function goToLogin(t) {
    var user_type_id = t;


    var f = new FormData();
    f.append("user_type_id", user_type_id);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "ok") {
                window.location = "login.php";
            }
        }
    };
    r.open("POST", "selectuserprocess.php", true);
    r.send(f);
}

function studentRegister() {

    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var fullname = document.getElementById("fullname");
    var bdy = document.getElementById("bdy");
    var gender = document.getElementById("gender");
    var adline1 = document.getElementById("adline1");
    var adline2 = document.getElementById("adline2");
    var city = document.getElementById("city");
    var contact = document.getElementById("contact");
    var email = document.getElementById("email");
    var password = document.getElementById("password");
    var repassword = document.getElementById("repassword");
    var agree = document.getElementById("agreeTerms");

    var f = new FormData();
    f.append("fname", fname.value);
    f.append("lname", lname.value);
    f.append("fullname", fullname.value);
    f.append("bdy", bdy.value);
    f.append("gender", gender.value);
    f.append("adline1", adline1.value);
    f.append("adline2", adline2.value);
    f.append("city", city.value);
    f.append("contact", contact.value);
    f.append("email", email.value);
    f.append("password", password.value);
    f.append("repassword", repassword.value);
    f.append("agree", agree.checked);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                alert("Signup Success & wait for approval..");
                fname.value = "";
                lname.value = "";
                fullname.value = "";
                bdy.value = "";
                gender.value = "0";
                adline1.value = "";
                adline2.value = "";
                city.value = "";
                contact.value = "";
                email.value = "";
                password.value = "";
                repassword.value = "";
                agree.checked = "false";
                document.getElementById("msg").innerHTML = "";
            } else {
                document.getElementById("msg").innerHTML = text;
            }

        }
    };
    r.open("POST", "studentRegProcess.php", true);
    r.send(f);

}

function userLogin(id) {

    var uti = id;
    var username = document.getElementById("username");
    var password = document.getElementById("password");
    var remember = document.getElementById("remember");

    var f = new FormData();
    f.append("uti", uti);
    f.append("username", username.value);
    f.append("password", password.value);
    f.append("remember", remember.checked);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                document.getElementById("lomsg").innerHTML = "";
                window.location = "index.php";
            } else if (text == "firstlogin") {
                firstloginverifymodal();
            } else {
                document.getElementById("lomsg").innerHTML = text;
            }
            // alert(text);
        }
    };
    r.open("POST", "userLoginProcess.php", true);
    r.send(f);
}

var m0;

function firstloginverifymodal() {
    var firstmodal = document.getElementById("firstloginverifymodal");
    m0 = new bootstrap.Modal(firstmodal);
    m0.show();
}

function firstLoginVerify() {
    var vcode = document.getElementById("vcode");

    var f = new FormData();
    f.append("vcode", vcode.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                vcode.value = "";
                document.getElementById("fmsg").innerHTML = "";
                m0.hide();
                window.location = "index.php";
            } else {
                document.getElementById("fmsg").innerHTML = text;
            }

        }
    };

    r.open("POST", "firsLoginVerifyProcess.php", true);
    r.send(f);
}


var m1;

function sendmaindetailsmodal() {
    var maindmodal = document.getElementById("sendmaindetailsmodal");
    m1 = new bootstrap.Modal(maindmodal);
    m1.show();
}


var m2;

function adminLogin() {
    var email = document.getElementById("email");
    var password = document.getElementById("password");

    var f = new FormData();
    f.append("email", email.value);
    f.append("password", password.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            // alert(text);
            if (text == "success") {
                email.value = "";
                password.value = "";
                document.getElementById("lmsg").innerHTML = "";

                var adminverify = document.getElementById("adminverifymodal");
                m2 = new bootstrap.Modal(adminverify);
                m2.show();
            } else {
                document.getElementById("lmsg").innerHTML = text;
            }
        }
    };
    r.open("POST", "adminLoginProcess.php", true);
    r.send(f);
}

function adminVerify() {
    var verificationcode = document.getElementById("vc");

    var f = new FormData();
    f.append("verification_code", verificationcode.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                verificationcode.value = "";
                document.getElementById("vmsg").innerHTML = "";
                m2.hide();
                window.location = "index.php";
            } else {
                document.getElementById("vmsg").innerHTML = text;
            }

        }
    };

    r.open("POST", "adminVerifyProcess.php", true);
    r.send(f);
}

function updateAdminProfile() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var fullname = document.getElementById("fullname");
    var title = document.getElementById("title");
    var adline1 = document.getElementById("adline1");
    var adline2 = document.getElementById("adline2");
    var city = document.getElementById("city");

    var f = new FormData();
    f.append("fname", fname.value);
    f.append("lname", lname.value);
    f.append("fullname", fullname.value);
    f.append("title", title.value);
    f.append("adline1", adline1.value);
    f.append("adline2", adline2.value);
    f.append("city", city.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                document.getElementById("uamsg").innerHTML = "";
                window.onload = loadAdminProfile();
                alert("Update Success");

            } else {
                document.getElementById("uamsg").innerHTML = text;
            }

        }
    };
    r.open("POST", "updateProfile.php", true);
    r.send(f);
}

function sendMainDetails() {

    var fullname = document.getElementById("fullname");
    var email = document.getElementById("email");
    var mobile = document.getElementById("mobile");

    var f = new FormData();
    f.append("fullname", fullname.value);
    f.append("email", email.value);
    f.append("mobile", mobile.value);


    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                fullname.value = "";
                email.value = "";
                mobile.value = "";
                document.getElementById("mdmsg").innerHTML = "";
                alert("Submitted.. Waiting for registration and check your email..");
                m1.hide();
            } else {
                document.getElementById("mdmsg").innerHTML = text;
            }
            // alert(text);
        }
    };
    r.open("POST", "sendMainDetails.php", true);
    r.send(f);
}

function sendRegisterEmailO(id) {
    var uid = id;

    var f = new FormData();
    f.append("uid", uid);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                alert("Email Sent.");
                window.onload = loadAOfficerRegistration();
            } else {
                alert(text);
            }
            // alert(text);
        }
    };
    r.open("POST", "sendRegisterEmail.php", true);
    r.send(f);
}

function sendRegisterEmailT(id) {
    var uid = id;

    var f = new FormData();
    f.append("uid", uid);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                alert("Email Sent.");
                window.onload = loadTeacherRegistration();
            } else {
                alert(text);
            }
            // alert(text);
        }
    };
    r.open("POST", "sendRegisterEmail.php", true);
    r.send(f);
}

function registerTandO() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var fullname = document.getElementById("fullname");
    var bdy = document.getElementById("bdy");
    var title = document.getElementById("title");
    var adline1 = document.getElementById("adline1");
    var adline2 = document.getElementById("adline2");
    var city = document.getElementById("city");
    var nic = document.getElementById("nic");
    var contact = document.getElementById("contact");
    var username = document.getElementById("username");
    var email = document.getElementById("email");
    var password = document.getElementById("password");
    var vcode = document.getElementById("vcode");
    var agree = document.getElementById("agreeTerms");

    var f = new FormData();
    f.append("fname", fname.value);
    f.append("lname", lname.value);
    f.append("fullname", fullname.value);
    f.append("bdy", bdy.value);
    f.append("title", title.value);
    f.append("adline1", adline1.value);
    f.append("adline2", adline2.value);
    f.append("city", city.value);
    f.append("nic", nic.value);
    f.append("contact", contact.value);
    f.append("username", username.value);
    f.append("email", email.value);
    f.append("password", password.value);
    f.append("vcode", vcode.value);
    f.append("agree", agree.checked);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                alert("Your Process Done.");
                fname.value = "";
                lname.value = "";
                fullname.value = "";
                bdy.value = "";
                title.value = "0";
                adline1.value = "";
                adline2.value = "";
                city.value = "";
                nic.value = "";
                contact.value = "";
                username.value = "";
                email.value = "";
                password.value = "";
                vcode.value = "";
                agree.checked = "false";
                document.getElementById("rmsg").innerHTML = "";
                window.location = "index.php";
            } else {
                document.getElementById("rmsg").innerHTML = text;
            }

        }
    };
    r.open("POST", "tandoRegProcess.php", true);
    r.send(f);
}

function blockuserMO(id) {
    var uid = id;

    var f = new FormData();
    f.append("uid", uid);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                window.onload = loadManageAOfficers();
            } else {
                alert(text);
            }
            // alert(text);
        }
    };
    r.open("POST", "blockUserProcess.php", true);
    r.send(f);
}

function blockuserMT(id) {
    var uid = id;

    var f = new FormData();
    f.append("uid", uid);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                window.onload = loadManageTeachers();
            } else {
                alert(text);
            }
            // alert(text);
        }
    };
    r.open("POST", "blockUserProcess.php", true);
    r.send(f);
}

function blockuserRO(id) {
    var uid = id;

    var f = new FormData();
    f.append("uid", uid);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                window.onload = loadAOfficerRegistration();
            } else {
                alert(text);
            }
            // alert(text);
        }
    };
    r.open("POST", "blockUserProcess.php", true);
    r.send(f);
}

function blockuserRT(id) {
    var uid = id;

    var f = new FormData();
    f.append("uid", uid);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                window.onload = loadTeacherRegistration();
            } else {
                alert(text);
            }
            // alert(text);
        }
    };
    r.open("POST", "blockUserProcess.php", true);
    r.send(f);
}

var m3;

function logoutModal() {
    // alert("okk");
    var logoutmodal = document.getElementById("logoutModal");
    m3 = new bootstrap.Modal(logoutmodal);
    m3.show();
}

function a() {
    alert("ok");
}

function logout() {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText

            if (t == "success") {
                window.location = "entrance.php";
            }
        }
    }

    r.open("GET", "logout.php", true);
    r.send();
}

function sendRegisterEmailS(id) {
    var uid = id;

    var f = new FormData();
    f.append("uid", uid);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                alert("Email Sent.");
                window.onload = loadRegisterStudents();
            } else {
                alert(text);
            }
            // alert(text);
        }
    };
    r.open("POST", "sendRegisterEmailST.php", true);
    r.send(f);
}

function blockuserRS(id) {
    var uid = id;

    var f = new FormData();
    f.append("uid", uid);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                window.onload = loadRegisterStudents();
            } else {
                alert(text);
            }
            // alert(text);
        }
    };
    r.open("POST", "blockUserProcess.php", true);
    r.send(f);
}

function updateUserProfile() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var fullname = document.getElementById("fullname");
    var title = document.getElementById("title");
    var adline1 = document.getElementById("adline1");
    var adline2 = document.getElementById("adline2");
    var city = document.getElementById("city");

    var f = new FormData();
    f.append("fname", fname.value);
    f.append("lname", lname.value);
    f.append("fullname", fullname.value);
    f.append("title", title.value);
    f.append("adline1", adline1.value);
    f.append("adline2", adline2.value);
    f.append("city", city.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                document.getElementById("uumsg").innerHTML = "";
                window.onload = loadUserProfile();
                alert("Update Success");

            } else {
                document.getElementById("uuamsg").innerHTML = text;
            }

        }
    };
    r.open("POST", "updateProfile.php", true);
    r.send(f);
}

function updateImage() {
    var uimage = document.getElementById("profileimg");
    var uview = document.getElementById("view");

    uimage.onchange = function() {
        var file = this.files[0];
        var url = window.URL.createObjectURL(file);
        uview.src = url;
        saveimage();
    }
}

function saveimage() {
    var img = document.getElementById("profileimg");

    var f = new FormData();
    f.append("img", img.files[0]);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);
            if (t == "success") {
                window.onload = loadUserProfile();
            }
        }
    };
    r.open("POST", "updateProfileImage.php", true);
    r.send(f);
}

function updateSImage() {
    var uimage = document.getElementById("profileimg");
    var uview = document.getElementById("view");

    uimage.onchange = function() {
        var file = this.files[0];
        var url = window.URL.createObjectURL(file);
        uview.src = url;
        saveSimage();
    }
}

function saveSimage() {
    var img = document.getElementById("profileimg");

    var f = new FormData();
    f.append("img", img.files[0]);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);
            if (t == "success") {
                window.onload = loadStudentProfile();
            }
        }
    };
    r.open("POST", "updateProfileImage.php", true);
    r.send(f);
}

function updateStudentProfile() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var fullname = document.getElementById("fullname");
    var adline1 = document.getElementById("adline1");
    var adline2 = document.getElementById("adline2");
    var city = document.getElementById("city");

    var f = new FormData();
    f.append("fname", fname.value);
    f.append("lname", lname.value);
    f.append("fullname", fullname.value);
    f.append("adline1", adline1.value);
    f.append("adline2", adline2.value);
    f.append("city", city.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                document.getElementById("sumsg").innerHTML = "";
                window.onload = loadStudentProfile();
                alert("Update Success");

            } else {
                document.getElementById("suamsg").innerHTML = text;
            }

        }
    };
    r.open("POST", "updateStudentProfile.php", true);
    r.send(f);
}

function saveGrade() {
    var grade = document.getElementById("grade");

    var f = new FormData();
    f.append("grade", grade.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                loadSubjects();
            } else {
                document.getElementById("gsmsg").innerHTML = text;
            }
            // alert(text);
        }
    };
    r.open("POST", "saveGrade.php", true);
    r.send(f);
}

var msub

function loadSubjects() {
    var subjectmodal = document.getElementById("subjectModal");
    msub = new bootstrap.Modal(subjectmodal);
    msub.show();
}



function dashboard() {
    var xml = new XMLHttpRequest();
    xml.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('content').innerHTML = xml.responseText;
        }
    }
    xml.open("GET", "dashboard.php");
    xml.send();
}
window.onload = dashboard();

function loadRegisterStudents() {
    var xml = new XMLHttpRequest();
    xml.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('content').innerHTML = xml.responseText;
        }
    }
    xml.open("GET", "studentregistration.php");
    xml.send();
}

function loadUserProfile() {
    var xml = new XMLHttpRequest();
    xml.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('content').innerHTML = xml.responseText;
        }
    }
    xml.open("GET", "userprofile.php");
    xml.send();
}

function loadStudentProfile() {
    var xml = new XMLHttpRequest();
    xml.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('content').innerHTML = xml.responseText;
        }
    }
    xml.open("GET", "studentprofile.php");
    xml.send();
}











function loadAdminProfile() {

    var xml = new XMLHttpRequest();
    xml.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('content').innerHTML = xml.responseText;
        }
    }
    xml.open("GET", "adminprofile.php");
    xml.send();
}

function loadAOfficerRegistration() {

    var xml = new XMLHttpRequest();
    xml.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('content').innerHTML = xml.responseText;
        }
    }
    xml.open("GET", "aofficerregistration.php");
    xml.send();
}

function loadTeacherRegistration() {

    var xml = new XMLHttpRequest();
    xml.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('content').innerHTML = xml.responseText;
        }
    }
    xml.open("GET", "teacherregistration.php");
    xml.send();
}

function loadManageAOfficers() {

    var xml = new XMLHttpRequest();
    xml.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('content').innerHTML = xml.responseText;
        }
    }
    xml.open("GET", "manageaofficers.php");
    xml.send();
}

function loadManageTeachers() {
    var xml = new XMLHttpRequest();
    xml.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('content').innerHTML = xml.responseText;
        }
    }
    xml.open("GET", "manageteachers.php");
    xml.send();
}