
<section class="promo">
        <h2 class="promo__title">Нужен стафф для катки?</h2>
        <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
        <ul class="promo__list">
            <li class="promo__item promo__item--boards">
                <a class="promo__link" href="all-lots.html">Доски и лыжи</a>
            </li>
            <li class="promo__item promo__item--attachment">
                <a class="promo__link" href="all-lots.html">Крепления</a>
            </li>
            <li class="promo__item promo__item--boots">
                <a class="promo__link" href="all-lots.html">Ботинки</a>
            </li>
            <li class="promo__item promo__item--clothing">
                <a class="promo__link" href="all-lots.html">Одежда</a>
            </li>
            <li class="promo__item promo__item--tools">
                <a class="promo__link" href="all-lots.html">Инструменты</a>
            </li>
            <li class="promo__item promo__item--other">
                <a class="promo__link" href="all-lots.html">Разное</a>
            </li>
        </ul>
    </section>
    <section class="lots">
        <div class="lots__header">
            <h2>Открытые лоты</h2>
        </div>
        <ul class="lots__list">
            <?php $lotsList = [ [ 'item' => '2014 Rossignol District Snowboard',
                                    'category' => 'Доски и лыжи', 'price' => 10999, 'pic' => 'img/lot-1.jpg', 'alt' => 'Сноуборд'],
                                [ 'item' => 'DC Ply Mens 2016/2017 Snowboard',
                                    'category' => 'Доски и лыжи', 'price' => 159999, 'pic' => 'img/lot-2.jpg', 'alt' => 'Сноуборд'],
                                [ 'item' => 'Крепления Union Contact Pro 2015 года размер L/XL',
                                    'category' => 'Крепления', 'price' => 8000, 'pic' => 'img/lot-3.jpg', 'alt' => 'Крепления'],
                                [ 'item' => 'Ботинки для сноуборда DC Mutiny Charocal',
                                    'category' => 'Ботинки', 'price' => 10999, 'pic' => 'img/lot-4.jpg', 'alt' => 'Ботинки'],
                                [ 'item' => 'Куртка для сноуборда DC Mutiny Charocal',
                                    'category' => 'Одежда', 'price' => 7500, 'pic' => 'img/lot-5.jpg', 'alt' => 'Куртка'],
                                [ 'item' => 'Маска Oakley Canopy',
                                    'category' => 'Разное', 'price' => 5400, 'pic' => 'img/lot-6.jpg', 'alt' => 'Маска']
            ]?>
            <?php for ($i = 0; $i < count($lotsList); $i++){ ?>
            <li class="lots__item lot">
                <div class="lot__image">
                    <img src=<?= $lotsList[$i]['pic']?> width="350" height="260" alt= <?= $lotsList[$i]['alt'] ?> >
                </div>
                <div class="lot__info">
                    <span class="lot__category"> <?= $lotsList[$i]['category'] ?> </span>
                    <h3 class="lot__title"><a class="text-link" href="lot.html"><?= $lotsList[$i]['item'] ?></a></h3>
                    <div class="lot__state">
                        <div class="lot__rate">
                            <span class="lot__amount">Стартовая цена</span>
                            <span class="lot__cost"> <?= formStr($lotsList[$i]['price']) ?></span>
                        </div>
                        <div class="lot__timer timer">
                            <?=$timer?>
                        </div>
                    </div>
                </div>
            </li>
            <?php } ?>
        </ul>
    </section>
