<?php
require_once('../model/data_access.php');

/**
 * Returns number of blanks for a black card.
 * Blanks correspond to the 'Cards Agains Humanity'
 * caracteristics. A black card can either have one
 * or two blanks.
 *
 * @param string $id_card
 * @return integer number of blanks for the black card
 */
function card_blanks_count(string $id_card): int
{
  if ('B' !== substr($id_card, 0, 1))
    throw new Exception('Invalid card: Expected Black card');
  $res = substr($id_card, 1, 1);
  if (!is_numeric($res))
    throw new Exception('Invalid card id');
  return $res;
}