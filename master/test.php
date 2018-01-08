<script>
//https://stackoverflow.com/questions/40589397/firebase-db-how-to-update-particular-value-of-child-in-firebase-database
    var timeOutSet;
    $(function () {
        startTime();
    });
    // Initialize Firebase
    var config = {
        apiKey: "",
        authDomain: "",
        databaseURL: "",
        projectId: "",
        storageBucket: "",
        messagingSenderId: ""
    };
    firebase.initializeApp(config);
    var firebase_ref = firebase.database().ref('Table_name');

    firebase_ref.on('value', function (data) {
        load();

    });
    /******/
    ref.push({
        mid: mid,
        time: new Date().getTime(),
        branch: getURLParameter('b'),
    });
    /****/


    function pushFirbaseCheckin(mid) {
       
        var ref = firebase.database().ref('Table_name');
        //  firebase_ref.child("checkinnow").set(mid);

        ref.push({
            mid: mid,
            time: new Date().getTime(),
            branch: getURLParameter('b'),
        });
    }
    
    function getURLParameter(name) {
        return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search) || [null, ''])[1].replace(/\+/g, '%20')) || null;
    }
    function load() {
        var firebase_ref = firebase.database().ref('menber_checkin');
    
        firebase_ref.once('value').then(function (snapshot) {
            snapshot.forEach(function (datasnapshot) {
                var data = datasnapshot.val();
                
                if ((data.time * 1) > time && getCookie('b_id') == data.branch) {
                    time = data.time;
                    id = data.mid;
                    key = datasnapshot.key;

                }
            });


            Viewcheckin(id);
            LoadTableMenberCheckIN();
            getExpired();
        });


    }


</script>