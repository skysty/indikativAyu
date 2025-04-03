<?php
/**
 * Created by PhpStorm.
 * User: erzhigit@tagay.kz
 * Date: 21.08.2023
 * Time: 14:59
 *	@example ER_Locale.get("Слово")
 */
$aTempLocale = array(
    'Иә, жоямын!' => $oL::get('Иә, жоямын!'),
    'Жоқ' => $oL::get('Жоқ'),
    'Факультеттің орта балы' => $oL::get('Факультеттің орта балы'),
    'Сіз сенімдісіз бе?' => $oL::get('Сіз сенімдісіз бе?'),
    'Жүктеген еңбегіңізді қайтара алмайсыз!' => $oL::get('Жүктеген еңбегіңізді қайтара алмайсыз!'),
);
?>

ER_Locale = $.parseJSON('<?= addslashes(json_encode($aTempLocale)) ?>');
ER_Locale.lang = '<?= $_SESSION['lang'] ?? 'kaz'?>';
ER_Locale.get = function(sWord)
{
    return this[ sWord ] || sWord; // TODO: Case insensitive
}