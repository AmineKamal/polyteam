<?php

$string['pluginname'] = 'Polyteam Generator';
$string['polyteamgenerator'] = 'Polyteam';

/*
 * MODÈLES
*/

// Générateur

// Forme
$string['toggleview'] = 'Basculer la vue';
$string['teamsize'] = 'Taille de l\'équipe';
$string['teamsizepreference'] = 'Préférence de taille d\'équipe';
$string['groupingname'] = 'Nom du groupement';
$string['prefix'] = 'Prefix';
$string['algorithms'] = "Algorithmes";
$string['algorithms:random'] = "Random";
$string['algorithms:mbti'] = "MBTI";
$string['sections'] = "Sections";
$string['generate'] = "Générer";
$string['sections:all'] = "Toutes les sections";

// Sections d'aide
$string["teamsize:help:label"] = "Aide sur la taille de l'équipe";
$string["teamsize:help:content"] = "L'entrée Taille de l'équipe détermine la plage acceptable pour la taille de l'équipe [min, max].";
$string["teamsizepreference:help:label"] = "Aide sur la préférence de taille d'équipe";
$string["teamsizepreference:help:content"] = "L'entrée Préférence de taille d'équipe détermine s'il faut utiliser la plus petite taille d'équipe possible ou la plus grande.";
$string["groupingname:help:label"] = "Aide sur le nom de regroupement";
$string["groupingname:help:content"] = "L'entrée Nom du groupement d'équipe fait référence au nom du groupement qui contiendra toutes les équipes créées. Le groupement ne sera pas créé si le champ est laissé vide.";
$string["prefix:help:label"] = "Aide avec Team Prefix";
$string["prefix:help:content"] = "L'entrée du préfixe ajoutera le préfixe à tous les noms d'équipe. Le suffixe sera généré avec l'index d'équipe à partir de 00.";
$string["algorithms:help:label"] = "Aide avec les algorithmes";
$string["algorithms:help:content"] = "L'entrée Algorithmes détermine quel algorithme sera utilisé pour la création de l'équipe.";
$string["sections:help:label"] = "Aide avec les sections";
$string["sections:help:content"] = "L'entrée Sections répertorie toutes les sections disponibles à utiliser pour la création des équipes. Les équipes seront créées avec les membres de toutes les sections sélectionnées.";

// Questionnaire

// Forme
$string['send'] = 'Envoyer';

// Sections
$string['Energy-Direction'] = 'Direction de l\'énergie';
$string['Orientation'] = 'Orientation';
$string['Information-Collection-Process'] = 'Processus de collecte d\'informations';
$string['Decision-Making-Process'] = 'Processus de prise de décision';

// Des questions
$string['youaremore'] = 'Vous êtes plus:';
$string['youprefer'] = 'Vous préférez:';
$string['youlearnbetterby'] = 'Vous apprenez mieux en:';
$string['youpreferactivities'] = 'Vous préférez les activités:';
$string['youworkbetter'] = 'Vous travaillez mieux:';
$string['youpreferthe'] = 'Vous préférez le:';
$string['youseeyourselfasmore'] = 'Vous vous voyez comme plus:';
$string['youthinkjudgesshouldbe'] = 'Vous pensez que les juges devraient être:';

// Réponses
$string['Sociable'] = 'Sociable';
$string['Reserved'] = 'Réservé';
$string['Expressive'] = 'Expressif';
$string['Contained'] = 'Contained';
$string['Groups'] = 'Groupes';
$string['Individuals'] = 'Individus';
$string['Listening'] = 'Listening';
$string['Reading'] = 'Reading';
$string['Talkative'] = 'Talkative';
$string['Quiet'] = 'Silencieux';
$string['Systematic'] = 'Systématique';
$string['Casual'] = 'Casual';
$string['Planned'] = 'Planifié';
$string['Open-ends'] = 'Ouvert';
$string['With-pressure'] = 'Avec pression';
$string['Without-pressure'] = 'Sans pression';
$string['Routine'] = 'Routine';
$string['Variety'] = 'Variété';
$string['Methodical'] = 'Methodical';
$string['Improvisational'] = 'Improvisational';
$string['Concrete'] = 'Concret';
$string['Abstract'] = 'Abstrait';
$string['Fact-Finding'] = 'Recherche de faits';
$string['Speculating'] = 'Spéculer';
$string['Practical'] = 'Pratique';
$string['Conceptual'] = 'Conceptuel';
$string['Hands-on'] = 'Pratique';
$string['Theoretical'] = 'Théorique';
$string['Traditional'] = 'Traditionnel';
$string['Novel'] = 'Roman';
$string['Logic'] = 'Logic';
$string['Empathy'] = 'Empathie';
$string['Truthful'] = 'Truthful';
$string['Tactful'] = 'Tactful';
$string['Questioning'] = 'Questioning';
$string['Accommodating'] = 'Accommodant';
$string['Skeptical'] = 'Sceptique';
$string['Tolerant'] = 'Tolérant';
$string['Impartial'] = 'Impartial';
$string['Merciful'] = 'Miséricordieux';

// Codes d'erreur

$string['error:code:invalid-team-size-range'] = "La plage fournie pour la taille de l'équipe n'est pas valide pour le nombre d'étudiants.";
$string['error:code:invalid-prefix'] = "Le préfixe fourni est déjà utilisé par d'autres noms d'équipe et il peut y avoir des conflits.";
$string['error:code:general'] = "Il semble que nous ayons quelques problèmes, veuillez réessayer plus tard.";