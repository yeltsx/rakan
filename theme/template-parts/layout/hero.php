<?php
$hero = get_field('hero');
if( $hero ): ?>
<section class="pt-10 overflow-hidden bg-gray-200 md:pt-0 sm:pt-16 2xl:pt-16">
    <div class="px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl">
        <div class="grid items-center grid-cols-1 md:grid-cols-2">
            <div>
                <h2 class="text-4xl font-bold leading-tight text-black sm:text-4xl lg:text-4xl"><?php echo $hero['titulo']; ?></h2>
                
                <h3 class="text-xl font-bold text-black sm:text-2xl lg:text-2xl mt-4"><?php echo $hero['subtitulo']; ?></h3>
                
                <p class="max-w-lg mt-3 text-xl leading-relaxed text-gray-600 md:mt-8"><?php echo $hero['descricao']; ?></p>

                <iframe src="https://embeds.beehiiv.com/b7697ebc-a633-4d63-be26-39c84d931a2d?slim=true" data-test-id="beehiiv-embed" height="52" class="max-w-lg mt-8" width="100%" frameborder="0" scrolling="no"></iframe>
                <p class="mt-2 text-xs text-gray-500 dark:text-neutral-500">
                    Sem SPAM, desinscreva-se a qualquer momento.
                </p>
            </div>

            <div class="relative">
                <img class="absolute inset-x-0 bottom-0 -mb-48 -translate-x-1/2 left-1/2" src="https://cdn.rareblocks.xyz/collection/celebration/images/team/1/blob-shape.svg" alt="" />

                <img class="relative w-full xl:max-w-lg xl:mx-auto 2xl:origin-bottom 2xl:scale-110" src="<?php echo esc_url( $hero['imagem']['url'] ); ?>" alt="" />
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
