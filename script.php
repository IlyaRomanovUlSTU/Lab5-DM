<?php

/**
    * Функция для валидации введённой матрицы
    *
    * Функция удаляет пустые элементы посредством метода array_diff() и пустые строки посредством метода unset(), осуществляет проверку размера матрицы, наличия элементов, не сооветствующих формату входных данных
    *
    * @param matrix - введённая пользователем матрица    
*/

function validate(& $matrix)
{
    for ($i = 0; $i < count($matrix); $i++)
    {
        $matrix[$i] = array_diff($matrix[$i], array(""));
        if (count($matrix[$i]) == 0)
        {
            unset($matrix[$i]);
            $matrix = array_values($matrix);
            $i--;
        }
    }    
    if (count($matrix) == 0)
    {
        echo "Пропущено поле ввода!";
        exit;
    }
    
    for ($i = 0; $i < count($matrix); $i++)
    {
        if (count($matrix[$i]) != count($matrix))
        {
            echo "Введенная матрица не квадратная!";
            exit;
        }
    }
    for ($i = 0; $i < count($matrix); $i++)
    {
        for ($j = 0; $j < count($matrix[$i]); $j++)
        {
            if (mb_strlen($matrix[$i][$j]) != 1)
            {
                echo "Неправильный формат данных!";
                exit;
            }
            if ($matrix[$i][$j] != "0" && $matrix[$i][$j] != "1")
            {
                echo "Неправильный формат данных!";
                exit;
            }            
        }
    }    
}

/**
    *Основное тело программы
	*	
	*Здесь вызываются все необходимые программе функции
    *
    *Метод explode() позволяет разделять массив по пробелам или другим знакам
*/

$matrix = explode(PHP_EOL, $_POST["matrix"]);
for ($i = 0; $i < count($matrix); $i++)
{
    $matrix[$i] = explode(" ", $matrix[$i]);
    
}

validate($matrix);

for ($k = 0; $k < count($matrix); $k++)
{
    for ($i = 0; $i < count($matrix); $i++)
    {
        for ($j = 0; $j < count($matrix[$i]); $j++)
        {
            if ($matrix[$i][$k] == "1" && $matrix[$k][$j] == "1")
            {
                $matrix[$i][$j] = "1";
            }
        }
    }
}

echo "Матрица достижимости построена:<br><br>";
for ($i = 0; $i < count($matrix); $i++)
{
    for ($j = 0; $j < count($matrix[$i]) - 1; $j++)
    {
        echo $matrix[$i][$j] . " ";
    }
    echo $matrix[$i][count($matrix[$i]) - 1] . "<br>";
}

?>