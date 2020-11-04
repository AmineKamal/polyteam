<style>
    input {
        max-width: 100%;
    }

    #polyteam_block_questionnaire {
        display: none;
    }

    .is-warning {
        border-color: #FD6A02 !important;
        background-image: url("data:image/svg+xml,%3csvg xmlns=\'http://www.w3.org/2000/svg\' fill=\'%23FD6A02\' viewBox=\'-2 -2 7 7\'%3e%3cpath stroke=\'%23FD6A02\' d=\'M0 0l3 3m0-3L0 3\'/%3e%3ccircle r=\'.5\'/%3e%3ccircle cx=\'3\' r=\'.5\'/%3e%3ccircle cy=\'3\' r=\'.5\'/%3e%3ccircle cx=\'3\' cy=\'3\' r=\'.5\'/%3e%3c/svg%3E") !important;
    }

    .warning-feedback {
        color: #FD6A02 !important;
    }

</style>

<div style="width:100%; display:flex; justify-content:center; margin-bottom:15px">
    <button class="btn btn-primary" onclick="toggleView()"> <?php echo get_string("toggleview", "block_polyteamgenerator"); ?> </button>
</div>

<div style="min-width:100%" id="polyteam_block_generator">
    <form action="javascript:void(0);">
        <div id="fitem_id_block_polyteamgenerator_team_size" class="form-group row fitem">
            <div class="col-md-5">
                <span class="float-sm-right text-nowrap">
                    <a class="btn btn-link p-0" role="button" data-container="body" data-toggle="popover" data-placement="right" data-content="<div class=&quot;no-overflow&quot;><p><?php echo get_string("teamsize:help:content", "block_polyteamgenerator"); ?></p></div> " data-html="true" tabindex="0" data-trigger="focus">
                        <i class="icon fa fa-question-circle text-info fa-fw " title="<?php echo get_string("teamsize:help:label", "block_polyteamgenerator"); ?>" aria-label="<?php echo get_string("teamsize:help:label", "block_polyteamgenerator"); ?>"></i>
                    </a>
                </span>
                <label class="col-form-label d-inline " for="id_block_polyteamgenerator_team_size"> <?php echo get_string("teamsize", "block_polyteamgenerator"); ?> </label>
            </div>
            <div class="col-md-7">
                <div class="row">
                    <div class="col-md-6 form-inline felement" data-fieldtype="number">
                        <input type="number" class="form-control" id="id_block_polyteamgenerator_team_size_min" placeholder="Min" style="padding: 0;padding-left: 5px;">
                    </div>
                    <div class="col-md-6 form-inline felement" data-fieldtype="number">
                        <input type="number" class="form-control" id="id_block_polyteamgenerator_team_size_max" placeholder="Max" style="padding: 0;padding-left: 5px;">
                    </div>
                </div>
                <div class="form-control-feedback invalid-feedback" id="id_error_block_polyteamgenerator_team_size">ERROR</div>
            </div>
        </div>

        <div id="fitem_id_block_polyteamgenerator_team_size_preference" class="form-group row fitem">
            <div class="col-md-5">
                <span class="float-sm-right text-nowrap">
                    <a class="btn btn-link p-0" role="button" data-container="body" data-toggle="popover" data-placement="right" data-content="<div class=&quot;no-overflow&quot;><p><?php echo get_string("teamsizepreference:help:content", "block_polyteamgenerator"); ?></p></div> " data-html="true" tabindex="0" data-trigger="focus">
                        <i class="icon fa fa-question-circle text-info fa-fw " title="<?php echo get_string("teamsizepreference:help:label", "block_polyteamgenerator"); ?>" aria-label="<?php echo get_string("teamsizepreference:help:label", "block_polyteamgenerator"); ?>"></i>
                    </a>
                </span>
                <label class="col-form-label d-inline " for="id_block_polyteamgenerator_team_size_preference">
                    <?php echo get_string("teamsizepreference", "block_polyteamgenerator"); ?>
                </label>
            </div>
            <div class="col-md-7 form-inline felement" data-fieldtype="select">
                <select class="custom-select" name="block_polyteamgenerator_team_size_preference" id="id_block_polyteamgenerator_team_size_preference">
                    <option value="min" selected>Min</option>
                    <option value="max">Max</option>
                </select>
                <div class="form-control-feedback invalid-feedback" id="id_error_block_polyteamgenerator_team_size_preference">
                ERROR
                </div>
            </div>
        </div>

        <div id="fitem_id_block_polyteamgenerator_grouping_name" class="form-group row fitem">
            <div class="col-md-5">
                <span class="float-sm-right text-nowrap">
                    <a class="btn btn-link p-0" role="button" data-container="body" data-toggle="popover" data-placement="right" data-content="<div class=&quot;no-overflow&quot;><p><?php echo get_string("groupingname:help:content", "block_polyteamgenerator"); ?></p></div> " data-html="true" tabindex="0" data-trigger="focus">
                        <i class="icon fa fa-question-circle text-info fa-fw " title="<?php echo get_string("groupingname:help:label", "block_polyteamgenerator"); ?>" aria-label="<?php echo get_string("groupingname:help:label", "block_polyteamgenerator"); ?>"></i>
                    </a>
                </span>
                <label class="col-form-label d-inline " for="id_block_polyteamgenerator_grouping_name"> <?php echo get_string("groupingname", "block_polyteamgenerator"); ?> </label>
            </div>
            <div class="col-md-7 form-inline felement" data-fieldtype="text">
                <input type="text" class="form-control" id="id_block_polyteamgenerator_grouping_name">
                <div class="form-control-feedback invalid-feedback" id="id_error_block_polyteamgenerator_grouping_name">ERROR</div>
            </div>
        </div>

        <div id="fitem_id_block_polyteamgenerator_prefix" class="form-group row fitem">
            <div class="col-md-5">
                <span class="float-sm-right text-nowrap">
                    <a class="btn btn-link p-0" role="button" data-container="body" data-toggle="popover" data-placement="right" data-content="<div class=&quot;no-overflow&quot;><p><?php echo get_string("prefix:help:content", "block_polyteamgenerator"); ?></p></div> " data-html="true" tabindex="0" data-trigger="focus">
                        <i class="icon fa fa-question-circle text-info fa-fw " title="<?php echo get_string("prefix:help:label", "block_polyteamgenerator"); ?>" aria-label="<?php echo get_string("prefix:help:label", "block_polyteamgenerator"); ?>"></i>
                    </a>
                </span>
                <label class="col-form-label d-inline " for="id_block_polyteamgenerator_prefix"> <?php echo get_string("prefix", "block_polyteamgenerator"); ?> </label>
            </div>
            <div class="col-md-7 form-inline felement" data-fieldtype="text">
                <input type="text" class="form-control" id="id_block_polyteamgenerator_prefix" value="gr_">
                <div class="form-control-feedback invalid-feedback" id="id_error_block_polyteamgenerator_prefix">ERROR</div>
            </div>
        </div>
        

        <div id="fitem_id_block_polyteamgenerator_algorithms" class="form-group row fitem">
            <div class="col-md-5">
                <span class="float-sm-right text-nowrap">
                    <a class="btn btn-link p-0" role="button" data-container="body" data-toggle="popover" data-placement="right" data-content="<div class=&quot;no-overflow&quot;><p><?php echo get_string("algorithms:help:content", "block_polyteamgenerator"); ?></p></div> " data-html="true" tabindex="0" data-trigger="focus">
                        <i class="icon fa fa-question-circle text-info fa-fw " title="<?php echo get_string("algorithms:help:label", "block_polyteamgenerator"); ?>" aria-label="<?php echo get_string("algorithms:help:label", "block_polyteamgenerator"); ?>"></i>
                    </a>
                </span>
                <label class="col-form-label d-inline " for="id_block_polyteamgenerator_algorithms">
                    <?php echo get_string("algorithms", "block_polyteamgenerator"); ?>
                </label>
            </div>
            <div class="col-md-7 form-inline felement" data-fieldtype="select">
                <select class="custom-select" name="block_polyteamgenerator_algorithms" id="id_block_polyteamgenerator_algorithms">
                    <option value="RANDOM" selected><?php echo get_string("algorithms:random", "block_polyteamgenerator"); ?></option>
                    <option value="MBTI"><?php echo get_string("algorithms:mbti", "block_polyteamgenerator"); ?></option>
                </select>
                <div class="form-control-feedback invalid-feedback" id="id_error_block_polyteamgenerator_algorithms">
                ERROR
                </div>
            </div>
        </div>

        <div id="fitem_id_block_polyteamgenerator_sections" class="form-group row fitem">
            <div class="col-md-5">
                <span class="float-sm-right text-nowrap">
                    <a class="btn btn-link p-0" role="button" data-container="body" data-toggle="popover" data-placement="right" data-content="<div class=&quot;no-overflow&quot;><p><?php echo get_string("sections:help:content", "block_polyteamgenerator"); ?></p></div> " data-html="true" tabindex="0" data-trigger="focus">
                        <i class="icon fa fa-question-circle text-info fa-fw " title="<?php echo get_string("sections:help:label", "block_polyteamgenerator"); ?>" aria-label="<?php echo get_string("sections:help:label", "block_polyteamgenerator"); ?>"></i>
                    </a>
                </span>
                <label class="col-form-label d-inline " for="id_block_polyteamgenerator_sections">
                    <?php echo get_string("sections", "block_polyteamgenerator"); ?>
                </label>
            </div>
            <div class="col-md-7 form-inline felement" data-fieldtype="select">
                <select class="custom-select" name="block_polyteamgenerator_sections" id="id_block_polyteamgenerator_sections" multiple>
                    <option value="All"><?php echo get_string("sections:all", "block_polyteamgenerator"); ?></option>
                    <?php 
                        foreach($sections as $section) {
                            echo '<option>' . $section . '</option>';
                        }
                    ?>
                </select>
                <div class="form-control-feedback invalid-feedback" id="id_error_block_polyteamgenerator_sections">
                ERROR
                </div>
            </div>
        </div>

        <button class="btn btn-primary" onclick="send()"><i id="id_icon_block_polyteamgenerator_loading_generate" style="display:none" class="fa fa-circle-o-notch fa-spin"></i> <?php echo get_string("generate", "block_polyteamgenerator"); ?> </button>
        <div class="form-control-feedback invalid-feedback" id="id_error_block_polyteamgenerator_general">
            ERROR
        </div>
    </form>
</div>

<?php include_once("block_questionnaire.php"); ?>

<script>
    let url = "<?=$url?>";
    let groupings = <?=$groupings?>;
    let gcodes = <?=$codes?>;
    let groupnames = <?=$groupnames?>;

    let activatedErrorFields = [];

    function parseForm() {
        const min = parseInt(document.getElementById("id_block_polyteamgenerator_team_size_min").value);
        const max = parseInt(document.getElementById("id_block_polyteamgenerator_team_size_max").value);
        const preference = document.getElementById("id_block_polyteamgenerator_team_size_preference");
        const teamSizePreference = preference.options[preference.selectedIndex].value;
        const groupingName = document.getElementById("id_block_polyteamgenerator_grouping_name").value;
        const prefix = document.getElementById("id_block_polyteamgenerator_prefix").value;
        const algorithms = document.getElementById("id_block_polyteamgenerator_algorithms");
        const algorithm = algorithms.options[algorithms.selectedIndex].value;
        const sections = getSelectValues(document.getElementById("id_block_polyteamgenerator_sections"));

        return {
            teamSize: {min, max},
            teamSizePreference,
            sections,
            groupingName,
            prefix,
            algorithm,
            groupings,
            groupnames
        };
    }

    function send() {
        const loading = document.getElementById("id_icon_block_polyteamgenerator_loading_generate");

        let xhr = new XMLHttpRequest();
        xhr.onload = () => {
            loading.style.display = "none";
            reset_errors();

            if (xhr.status >= 200 && xhr.status < 300) {
                const response = JSON.parse(xhr.responseText);
                download(response.csv, "csv", "groups.csv");
                download(JSON.stringify(response.teams, null, 4), "json", "groups.json");
            } else {
                const response = JSON.parse(xhr.responseText);

                if (response.severity === "WARNING") {
                    download(response.data.csv, "csv", "groups.csv");
                    download(JSON.stringify(response.data.teams, null, 4), "json", "groups.json");
                }

                if (!response.code) {
                    displayError("general", "ERROR");
                    return;
                }

                displayError(response.code, response.severity, response.input, response.suffixes);
            }
        };

        xhr.open("POST", url);
        xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xhr.send(JSON.stringify(parseForm()));
        loading.style.display = "inline-block";
    }

    function toggleView() {
        const generator = document.getElementById("polyteam_block_generator");
        const questionnaire = document.getElementById("polyteam_block_questionnaire");

        if (generator.style["display"] === "none") {
            generator.style["display"] = "block";
            questionnaire.style["display"] = "none";
        } else {
            generator.style["display"] = "none";
            questionnaire.style["display"] = "block";
        }
    }

    function download(data, type, filename) {
        let encodedUri = `data:text/${type};charset=utf-8,` + encodeURIComponent(data);
        let link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", filename);
        document.body.appendChild(link); // Required for FF
        link.click(); // This will download the data file named "groups.csv".
        link.remove();
    }

    function getSelectValues(select) {
        const result = [];
        const options = select && select.options;
        let opt;

        for (let i = 0; i < options.length; i++) {
            opt = options[i];

            if (opt.selected) {
                result.push(opt.value || opt.text);
            }
        }
        return result;
    }

    function displayError(errorCode, severity, inputName, suffixes = [""]) {
        suffixes.forEach(s => {
            let inputId, errorInputId;

            if (inputName) {
                inputId = "id_block_polyteamgenerator_" + inputName + (s ? "_" + s : s);
                errorInputId = "id_error_block_polyteamgenerator_" + inputName;
            } else {
                inputId = null;
                errorInputId = "id_error_block_polyteamgenerator_general";
            }
            
            let input;
            if (inputId) {
                input = document.getElementById(inputId);
            }
        
            const errorInput = document.getElementById(errorInputId);

            if (input) {
                if (severity === "WARNING") input.classList.add("is-warning");
                input.classList.add("is-invalid");
            }

            if (errorInput) {
                errorInput.style.display = "block";
                errorInput.innerHTML = "- " + gcodes[errorCode];
                if (severity === "WARNING") errorInput.classList.add("warning-feedback");
            }

            activatedErrorFields.push({inputId, errorInputId});
        });
    }

    function reset_errors() {
        activatedErrorFields.forEach(({inputId, errorInputId}) => {
            if (inputId) {
                const input = document.getElementById(inputId);
                input.classList.remove("is-invalid");
                input.classList.remove("is-warning");
            }

            if (errorInputId) {
                const errorInput = document.getElementById(errorInputId);
                errorInput.classList.remove("warning-feedback");
                errorInput.style.display = "none";
                errorInput.innerHTML = "";
            }
        });
    }

</script>