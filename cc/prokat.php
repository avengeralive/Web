<head>
    <title>Book Notes Application - Subjects</title>
    <script src="https://code.jquery.com/jquery-latest.min.js"
        type="text/javascript"></script>

    <script>
        $(document).ready(function(){
            $('#subject_id').change(function(){
                var subject_id = $(this).val();
                $.ajax({
                    url : "subject_ajax?subject_id=" + subject_id,
                    success : function(data) {
                        alert(data)

                        json = jQuery.parseJSON(data);
                    },
                    error : function() {
                        alert("Error");
                    }
                });
            })
        })

    </script>
</head>
<body>

    <!-- CHOOSE SUBJECT -->
    <FORM action="/books" id="choose_subject" name="choose_subject" method="POST">
        Choose a Subject:
        <select name="subject_id" id="subject_id">
            % for subject in subjects:
                <option value="{{subject.id}}">{{subject.name}}</option>
            % end
        </select><input type="submit" name="sub" value="Choose Subject"/>
        <BR />
    </FORM>