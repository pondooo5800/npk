<div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a class="site_title" href="<?php echo site_url('main/dashborad'); ?>">
              <img src="<?php echo base_url(); ?>assets/images/logo.png" width="48">
              <span>NPK SYSTEMS</span>

            </a>

          </div>

          <div class="clearfix"></div>


          <!-- menu profile quick info -->
          <br>
          <!-- //query year form db -->
          <?php $query = $this->db->query("select * from tbl_year");
          $years = $query->result();
          ?>

          <?php $sidemenu = $this->db->select('*')->order_by('app_sort', 'ASC')->get('usrm_application')->result_array(); ?>
          <!-- //end query year form db -->

          <div class="profile clearfix" style="margin-left: 5px;">
            <select onchange="changeYear(this)" class="selectpicker">
              <?php foreach ($years as $key => $value) { ?>
                <option <?php echo ($this->session->userdata('year') == $value->year_id)?'selected':'';?> value="<?= $value->year_id ?>">ปีงบประมาณ <?= $value->year_label ?></option>
              <?php
            } ?>
            </select>
          </div>
          <br>
          <!-- /menu profile quick info -->

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <ul class="nav side-menu">
                <li>
                    <a href="<?php echo site_url('main/dashborad'); ?>"> <i class="fa fa-home"></i> หน้าหลัก</a>
                </li>

              <?php foreach ($sidemenu as $key => $value) : ?>

                  <?php if ($value['app_parent_id'] == 0 && $value['app_link'] != null) : ?>
                    <?php foreach ($_SESSION['user_permission'] as $key => $login_per) : ?>
                      <?php if ($value['app_id'] == $login_per['app_id']) : ?>
                        <li>
                            <a href="<?php echo site_url($value['app_link']); ?>"> <i class="<?php echo $value['app_icon'] ?>"></i> <?php echo $value['app_name'] ?></a>
                        </li>
                      <?php endif; ?>
                    <?php endforeach; ?>

                  <?php elseif ($value['app_parent_id'] == 0 && $value['app_link'] == null) : ?>
                    <?php foreach ($_SESSION['user_permission'] as $key => $login_per) : ?>
                      <?php if ($value['app_id'] == $login_per['app_id']) : ?>
                    <li >
                      <a>
                        <i class="<?php echo $value['app_icon'] ?>"></i> <?php echo $value['app_name'] ?>
                        <span class="fa fa-chevron-down"></span>
                      </a>
                      <ul class="nav child_menu">
                        <?php foreach ($sidemenu as $key => $value2) : ?>
                          <?php foreach ($_SESSION['user_permission'] as $key => $value3) : ?>
                            <?php if ($value2['app_id'] == $value3['app_id'] && $value2['app_parent_id'] == $value['app_id']) : ?>
                              <?php $me = explode('/', $value2['app_link']);?>
                              <li id="<?= $me[0];?>" data-child="<?= @$me[1];?>">
                                <a href="<?php echo site_url($value2['app_link']); ?>"><?php echo $value2['app_name'] ?></a>
                              </li>
                            <?php endif; ?>
                          <?php endforeach; ?>
                        <?php endforeach; ?>
                      </ul>
                    </li>
                  <?php endif; ?>
                <?php endforeach; ?>
                  <?php endif; ?>
                <?php endforeach; ?>

              </ul>
            </div>

          </div>
          <!-- /sidebar menu -->
        </div>
      </div>
