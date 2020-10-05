<div id="polyteam_block_questionnaire">
    <form action="javascript:void(0);">     
        <?php 
            foreach($questions as $si=>$qsection) {
                echo '<div style="width:100%">';
                echo '<h6 class="card-title d-inline">' . $qsection->title . '</h6>';

                foreach($qsection->questions as $qi=>$q) {
                    echo '<div style="display:flex; flex-direction: column; width:100%; border-bottom: solid 1px rgba(0,0,0,.125);padding:10px">';
                    echo '<label class="col-form-label d-inline">';
                    echo $q->q;
                    echo '</label>';
                    echo '<br>';
                    echo '<div class="form-inline felement" style="display: flex; justify-content: space-around;width:100%">';

                    echo '<div class="form-check">';
                    echo '<label>';
                    $a1id = "s" . $si . "q" . $qi . "1";
                    echo '<input type="checkbox" id="' . $a1id . '" class="form-check-input" value="' . $q->v1 . '">';
                    echo $q->a1;
                    echo '</label>';
                    echo '</div>';

                    echo '<div class="form-check">';
                    echo '<label>';
                    $a2id = "s" . $si . "q" . $qi . "2";
                    echo '<input type="checkbox" id="' . $a2id . '" class="form-check-input" value="' . $q->v2 . '">';
                    echo $q->a2;
                    echo '</label>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

                    echo '<br>';
                }

                echo '</div>';
                echo '<br>';
            }
        ?>
        

        <button class="btn btn-primary" onclick="sendQuestions()"><i id="id_icon_block_polyteamgenerator_loading_send" style="display:none" class="fa fa-circle-o-notch fa-spin"></i> <?php echo get_string("send", "block_polyteamgenerator"); ?> </button>
    </form>
</div>

<script>
    function parseQuestions() {
        const sections = <?=$jsQuestions?>;

        const keys = ["ei", "jp", "sn", "tf"];
        const answers = {
            ei: [],
            jp: [],
            sn: [],
            tf: []
        };

        sections.forEach((s, si) => {
            s.questions.forEach((q, qi) => {
                const cb1 = document.getElementById("s" + si + "q" + qi + "1");
                const cb2 = document.getElementById("s" + si + "q" + qi + "2");

                if (cb1.checked) answers[keys[si]].push(cb1.value);
                if (cb2.checked) answers[keys[si]].push(cb2.value);
            });
        });

        return answers;
    }


    function sendQuestions() {
        const loading = document.getElementById("id_icon_block_polyteamgenerator_loading_send");
        let xhr = new XMLHttpRequest();

        xhr.onload = () => {
            loading.style.display = "none";
            if (xhr.status >= 200 && xhr.status < 300) {
                const response = xhr.responseText;
                console.log(response);
                alert(response);
            }
        };

        xhr.open("POST", "/blocks/polyteamgenerator/api/block_send_questions.php");
        xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xhr.send(JSON.stringify(parseQuestions()));
        loading.style.display = "inline-block";
    }

</script>