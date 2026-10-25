<ul class="breadcrumb box-shadow box-corner" itemscope itemtype="http://schema.org/BreadcrumbList">
    <?php $cnt = count($breadcrumbs); $i = 0; foreach ($breadcrumbs as $key => $breadcrumb) { ?>
    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
        <?php $i++; if( $i != $cnt ) { ?>
        <a itemscope itemtype="http://schema.org/Thing" itemprop="item" href="<?php echo $breadcrumb['href']; ?>">
            <span itemprop="name"><?php echo $breadcrumb['text']; ?></span>
        </a>
        <?php } else { ?>
        <a itemscope itemtype="http://schema.org/Thing" itemprop="item" href="<?php echo $breadcrumb['href']; ?>">
            <span itemprop="name"><?php echo $breadcrumb['text']; ?></span>
        </a>
        <?php } ?>
        <meta itemprop="position" content="<?php echo $key+1; ?>" />
    </li>
    <?php } ?>
</ul>
