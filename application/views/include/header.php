<div class="header-top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <a class="logo" href="<?php echo base_url();?>">
                                <img src="<?php echo base_url();?>asset/img/logo-invert.png" alt="logo tambang hijau" title="" />
                            </a>
                        </div>
                        <div class="col-md-3 col-md-offset-2">
                            
                        </div>
                        <div class="col-md-4">
                            <div class="top-user-area clearfix">
                                <ul class="top-user-area-list list list-horizontal list-border">
                                    <!--<li class="top-user-area-avatar">
                                        <a href="user-profile.html">
                                            <img class="origin round" src="<?php echo base_url();?>asset/foto_profil/<?= $this->data_model->dataku("foto",$user_session); ?>" alt="img_avatar" title="Foto Anda" /><?= $user_session; ?></a>
                                    </li>-->
                                    <li><span id="date"></span>&nbsp;<span id="time"></span></li>
                                    <li><a class="btn btn-success" href="<?php echo base_url();?>login/logout" onclick="return confirm ('Apakah Anda Yakin Akan Logout?')">Sign Out</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>