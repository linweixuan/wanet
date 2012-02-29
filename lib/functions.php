<?php

/**
 * 
 * return a string of random text of a desired length
 *
 */ 
function random_text($count, $rm_similar = false)
{
    // create list of characters
    $chars = array_flip(array_merge(range(0, 9), range('A', 'Z')));

    // remove similar looking characters that might cause confusion
    if ($rm_similar)
    {
        unset($chars[0], $chars[1], $chars[2], $chars[5], $chars[8],
            $chars['B'], $chars['I'], $chars['O'], $chars['Q'],
            $chars['S'], $chars['U'], $chars['V'], $chars['Z']);
    }

    // generate the string of random text
    for ($i = 0, $text = ''; $i < $count; $i++)
    {
        $text .= array_rand($chars);
    }

    return $text;
}

/**
 * Checks to see if a string is utf8 encoded.
 *
 * NOTE: This function checks for 5-Byte sequences, UTF8
 *       has Bytes Sequences with a maximum length of 4.
 *
 * @param string $str The string to be checked
 * @return bool True if $str fits a UTF-8 model, false otherwise.
 */
function seems_utf8($str) 
{
	$length = strlen($str);
	for ($i=0; $i < $length; $i++) {
		$c = ord($str[$i]);
		if ($c < 0x80) $n = 0; # 0bbbbbbb
		elseif (($c & 0xE0) == 0xC0) $n=1; # 110bbbbb
		elseif (($c & 0xF0) == 0xE0) $n=2; # 1110bbbb
		elseif (($c & 0xF8) == 0xF0) $n=3; # 11110bbb
		elseif (($c & 0xFC) == 0xF8) $n=4; # 111110bb
		elseif (($c & 0xFE) == 0xFC) $n=5; # 1111110b
		else return false; # Does not match any model
		for ($j=0; $j<$n; $j++) { # n bytes matching 10bbbbbb follow ?
			if ((++$i == $length) || ((ord($str[$i]) & 0xC0) != 0x80))
				return false;
		}
	}
	return true;
}

/**
 * cut_str
 * 用于截断包含中文（或其他多字节？）的utf8编码的字符串
 * @param string $str utf8编码的字符串
 * @param int $len 需要截取的长度（单位是字节）
 */
function cut_str($str, $len) 
{
    if (!isset($str[$len])) {
        // 未达到时，直接输出原字符串
    } 
    else 
    {
        if (seems_utf8($str[$len-1])) 
            $str = substr($str, 0, $len);
        else 
        { 
        	// 如果不是utf8编码的，因为utf8编码的中文是三个字节进行保存的
        	// 则判断该字符和周围字符组成的字符串是否符合utf8编码
            if (seems_utf8($str[$len-3].$str[$len-2].$str[$len-1])) {
                $str = substr($str, 0, $len-3) . $str[$len-3] . $str[$len-2] . $str[$len-1];
            }
            elseif (seems_utf8($str[$len-2].$str[$len-1].$str[$len])) {
                $str = substr($str, 0, $len-2) . $str[$len-2].$str[$len-1].$str[$len];
            }
            elseif (seems_utf8($str[$len-1].$str[$len].$str[$len+1])) {
                $str = substr($str, 0, $len-1) . $str[$len-1].$str[$len].$str[$len+1];
            }
            else // 这个else应该不用也是可以的
                $str = substr($str, 0, $len);
        }
    }
    echo $str;
}

/**
 * cut_str
 * 用于截断包含中文(或其他多字节?)的utf8编码的字符串
 * $str 是要处理的字符串
 * $len 为截取的长度(即字数)
 */
function truncat($str,$len)
{
	$i = 0; 
	$n = 0;
	$return_str = '';
	$str_length = strlen($str);//字符串的字节数
	 
	while (($n < $len) and ($i <= $str_length))
	{
		//得到字符串中第$i位字符的ascii码
		$temp_str = substr($str,$i,1);
		$ascnum = Ord($temp_str);
		
		//如果ASCII位高与224，
		if ($ascnum >= 224)
		{
			//根据UTF-8编码规范，将3个连续的字符计为单个字符
			$return_str = $return_str.substr($str,$i,3); 
			$i = $i+3;     //实际Byte计为3
			$n++;          //字串长度计1
		}
		//如果ASCII位高与192，
		elseif ($ascnum >= 192) 
		{
			//根据UTF-8编码规范，将2个连续的字符计为单个字符
			$return_str = $return_str.substr($str,$i,2); 
			$i = $i+2;     //实际Byte计为2
			$n++;          //字串长度计1
		}
		//如果是大写字母
		elseif ($ascnum >= 65 && $ascnum <= 90) 
		{
			$return_str = $return_str.substr($str,$i,1);
			$i = $i+1;     //实际的Byte数仍计1个
			$n++;          //但考虑整体美观，大写字母计成一个高位字符
		}
		//其他情况下，包括小写字母和半角标点符号
		else               
		{
			$return_str = $return_str.substr($str,$i,1);
			$i = $i+1;     //实际的Byte数计1个
			$n = $n+0.5;   //小写字母和半角标点等与半个高位字符宽...
		}
	}
	
	//超过长度时在尾处加上省略号
	if ($str_length > $len){
		$return_str = $return_str . "...";
	}
	return $return_str;
}

?>
