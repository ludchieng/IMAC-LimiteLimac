<?php
/**
 * Functions concerning cards.
 * 
 * @package Card
 */

require_once('../model/data_access.php');
require_once('../model/log.php');


function create_card(string $pname, string $content, string $type): array
{
  if (!is_valid_type($type))
    throw new Exception('Invalid type');
  $sql = "SELECT MAX(SUBSTR(id_card,3,7)) as inc FROM card c
    WHERE id_card LIKE \"${type}%\"
  ";
  $inc = get_multiple($sql)[0]['inc'];
  $inc++;
  $inc = str_pad($inc, 5, "0", STR_PAD_LEFT);
  $id_pack = get_player($pname, 'id_pack');
  $sql = "INSERT INTO card (id_card, content, id_pack)
    VALUES (:id_card, :content, :id_pack);
  ";
  set_multiple($sql, $res = [
    'id_card' => $type . $inc,
    'content' => $content,
    'id_pack' => $id_pack
  ]);
  return $res;
}


function get_card(string $id_card, string $attr)
{
  return get('card', $id_card, $attr);
}


function set_card(string $id_card, string $attr, $value): void
{
  set('card', $id_card, $attr, $value);
}

/**
 * Returns number of blanks for a black card.
 * Blanks correspond to the 'Cards Agains Humanity'
 * caracteristics. A black card can either have one
 * or two blanks.
 *
 * @param string $id_card
 * @return integer number of blanks for the black card
 */
function get_card_blanks_count(string $id_card): int
{
  if ('B' !== substr($id_card, 0, 1))
    throw new Exception('Invalid card: Expected Black card');
  $res = substr($id_card, 1, 1);
  if (!is_numeric($res))
    throw new Exception('Invalid card id');
  return $res;
}


function is_valid_type(string $type): bool
{
  return in_array($type, ['W0', 'B1', 'B2']);
}


function create_pack(string $pname): array
{
  $sql = "INSERT INTO pack (name)
    VALUES ('{$pname}');
  ";
  set_multiple($sql);
  $sql = "SELECT id_pack FROM pack
    WHERE name = :pname ;
  ";
  $data = get_multiple($sql, ['pname' => $pname])[0];
  set_player($pname, 'id_pack', $data['id_pack']);
  $res['id_pack'] = $data['id_pack'];
  $res['name'] = $pname;
  return $res;
}