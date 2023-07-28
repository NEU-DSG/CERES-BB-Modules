<!-- input-form.php -->
<div class="image-module">
    <?php if ($enableZoom) : ?>
        <div class="img-container" style="overflow: hidden;">
            <img class="zoom-image" src="https://media.cntraveller.com/photos/61405fea3dd34b2a6b28a128/4:3/w_2664,h_1998,c_limit/KA_03_Succession_S02.jpg" alt="Image" align="<?php echo $imageAlignment; ?>" style="max-width: <?php echo $imageSize; ?>px;" />
        </div>
    <?php else : ?>
        <img src="https://media.cntraveller.com/photos/61405fea3dd34b2a6b28a128/4:3/w_2664,h_1998,c_limit/KA_03_Succession_S02.jpg" alt="Image" align="<?php echo $imageAlignment; ?>" style="max-width: <?php echo $imageSize; ?>px;" />
    <?php endif; ?>

    <?php if ($displayVideo) : ?>
        <div class="video-container">Video</div>
    <?php endif; ?>

    <?php if ($displayIssuu) : ?>
        <div class="issuu-container">Issuu Viewer</div>
    <?php endif; ?>

    <div class="image-caption" style="text-align: <?php echo $captionAlign; ?>;">Image Caption</div>

    <?php if ($enableZoom) : ?>
        <div class="zoom-icon zoom-position-<?php echo $zoomPosition; ?>"></div>
    <?php endif; ?>
</div>
