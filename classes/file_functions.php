<?php

function url_friendly_string($string) {
  $string = strtolower($string);
  $string = str_replace(' ', '-', $string);
  return $string;
}

function file_is_image($file) {
  $type = strtolower($file['type']);
  if ($type == "image/gif" || $type == "image/png" || $type == "image/jpeg" || $type == "image/jpg") {
    return true;
  } else {
    return false;
  }
}

function set_thumbnail_image($item, $file) {
  $filename = url_friendly_string($file['name']);
  $target = UPLOAD_DIR.basename($filename);

  if (!file_is_image($_FILES['thumbnail'])) {
    echo "file is not image";
    return false;
  }

  if ($item->thumbnail_url && file_exists(UPLOAD_DIR.$item->thumbnail_url)) {
    unlink(UPLOAD_DIR.$item->thumbnail_url);
  }

  if (move_uploaded_file($file['tmp_name'], $target)) {
    $thumbnail_url = 'img/thumbnail/'.basename($target);
	
    return $thumbnail_url;
  } else {
    return false;
  }
}

function set_thumbnail_image2($file) {
  $filename = url_friendly_string($file['name']);
  $target = UPLOAD_DIR.basename($filename);

  if (!file_is_image($_FILES['thumbnail'])) {
    echo "file is not image";
    return false;
  }

  if (move_uploaded_file($file['tmp_name'], $target)) {
    $thumbnail_url = 'img/thumbnail/'.basename($target);
	
    return $thumbnail_url;
  } else {
    return false;
  }
}
