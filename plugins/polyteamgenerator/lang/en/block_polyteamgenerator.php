<?php

$string['pluginname'] = 'Polyteam Generator';
$string['polyteamgenerator'] = 'Polyteam';
$string['polyteamgenerator:addinstance'] = 'Add a new simple HTML block';
$string['polyteamgenerator:myaddinstance'] = 'Add a new simple HTML block to the My Moodle page';

/**
 * TEMPLATES
*/

// Generator

// Form
$string['toggleview'] = 'Toggle View';
$string['teamsize'] = 'Team Size';
$string['teamsizepreference'] = 'Team Size Preference';
$string['groupingname'] = 'Grouping Name';
$string['prefix'] = 'Prefix';
$string['algorithms'] = "Algorithms";
$string['algorithms:random'] = "Random";
$string['algorithms:mbti'] = "MBTI";
$string['sections'] = "Sections";
$string['generate'] = "Generate";
$string['sections:all'] = "All Sections";

// Help Sections
$string["teamsize:help:label"] = "Help with Team Size";
$string["teamsize:help:content"] = "The Team Size input determines the acceptable range for the size of the team [min, max].";
$string["teamsizepreference:help:label"] = "Help with Team Size Preference";
$string["teamsizepreference:help:content"] = "The Team Size Preference input determines wether to use the smallest team size possible or the largest.";
$string["groupingname:help:label"] = "Help with Grouping Name";
$string["groupingname:help:content"] = "The Team Grouping Name input refers to the name of the grouping which will contain all the teams created. The grouping won't be created if the field is left blank.";
$string["prefix:help:label"] = "Help with Team Prefix";
$string["prefix:help:content"] = "The prefix input will add the prefix to all the team names. The suffix will be generated with the team index starting from 00.";
$string["algorithms:help:label"] = "Help with Algorithms";
$string["algorithms:help:content"] = "The Algorithms input determines what algorithm will be used for the team creation.";
$string["sections:help:label"] = "Help with Sections";
$string["sections:help:content"] = "The Sections input lists all the available sections to use for the creation of the teams. The teams will be created with the members of all the selected sections.";

// Questionnaire

// Form
$string['send'] = 'Send';

// Sections
$string['Energy-Direction'] = 'Energy Direction';
$string['Orientation'] = 'Orientation';
$string['Information-Collection-Process'] = 'Information Collection Process';
$string['Decision-Making-Process'] = 'Decision Making Process';

// Questions
$string['youaremore'] = 'You are more :';
$string['youprefer'] = 'You prefer :';
$string['youlearnbetterby'] = 'You learn better by :';
$string['youpreferactivities'] = 'You prefer activities :';
$string['youworkbetter'] = 'You work better :';
$string['youpreferthe'] = 'You prefer the :';
$string['youseeyourselfasmore'] = 'You see yourself as more :';
$string['youthinkjudgesshouldbe'] = 'You think judges should be :';

// Answers
$string['Sociable'] = 'Sociable';
$string['Reserved'] = 'Reserved';
$string['Expressive'] = 'Expressive';
$string['Contained'] = 'Contained';
$string['Groups'] = 'Groups';
$string['Individuals'] = 'Individuals';
$string['Listening'] = 'Listening';
$string['Reading'] = 'Reading';
$string['Talkative'] = 'Talkative';
$string['Quiet'] = 'Quiet';
$string['Systematic'] = 'Systematic';
$string['Casual'] = 'Casual';
$string['Planned'] = 'Planned';
$string['Open-ended'] = 'Open-ended';
$string['With-pressure'] = 'With pressure';
$string['Without-pressure'] = 'Without pressure';
$string['Routine'] = 'Routine';
$string['Variety'] = 'Variety';
$string['Methodical'] = 'Methodical';
$string['Improvisational'] = 'Improvisational';
$string['Concrete'] = 'Concrete';
$string['Abstract'] = 'Abstract';
$string['Fact-finding'] = 'Fact-finding';
$string['Speculating'] = 'Speculating';
$string['Practical'] = 'Practical';
$string['Conceptual'] = 'Conceptual';
$string['Hands-on'] = 'Hands-on';
$string['Theoretical'] = 'Theoretical';
$string['Traditional'] = 'Traditional';
$string['Novel'] = 'Novel';
$string['Logic'] = 'Logic';
$string['Empathy'] = 'Empathy';
$string['Truthful'] = 'Truthful';
$string['Tactful'] = 'Tactful';
$string['Questioning'] = 'Questioning';
$string['Accommodating'] = 'Accommodating';
$string['Skeptical'] = 'Skeptical';
$string['Tolerant'] = 'Tolerant';
$string['Impartial'] = 'Impartial';
$string['Merciful'] = 'Merciful';

// Error Codes

$string['error:code:invalid-team-size-range'] = "The provided range for the team size is not valid for the number of students.";
$string['error:code:invalid-prefix'] = "The provided prefix is already in use by other team names and there might be conflicts.";