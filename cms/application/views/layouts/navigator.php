<style>
.x-border-box, .x-border-box * {
    box-sizing:inherit;
}
</style>
<div class="nav-home<?=($this->router->class=='home')? '-select': '';?>">
	<img alt="" src="<?=base_url()?>public/img/icon/house.png" /> <span class="nav-title"><a href="<?=base_url()?>home" class="Lblue">หน้าแรก</a></span>
</div>
<hr class="navigator" />

<!-- Researcher -->
<div class="nav-title-<?=($this->router->class=='researcher')? 'select': 'default';?>">
	<div class="nav-text-title"><img alt="" src="<?=base_url()?>public/img/icon/group.png" /> <span class="nav-title"><a href="<?=base_url()?>researcher" class="Lblue">ข้อมูลนักวิจัย</a></span></div>
	<div class="nav-icon"><img alt="" src="<?=base_url()?>public/img/icon/<?=($this->router->class=='news')? 'resultset_up.png': 'resultset_down.png';?>" id="arrow1" class="nav-img-icon" onclick="changeStatus('1')" /></div>
</div>
<div id="nav-msg-body1" <?=($this->router->class=='researcher')? '': 'class=\'hide\'';?>>
	<div class="nav-body<?=($this->router->class=='researcher' && $this->router->method=='addnew')? '-select': '';?>"><a href="<?=base_url()?>researcher/addnew" class="LblueS">+เพิ่มนักวิจัย</a></div>
	<div class="nav-body<?=($this->router->class=='researcher' && $this->router->method=='index')? '-select': '';?>"><a href="<?=base_url()?>researcher" class="LblueS">นักวิจัยทั้งหมด</a></div>
</div>

<!-- Users -->
<div class="nav-title-<?=($this->router->class=='users')? 'select': 'default';?>">
	<div class="nav-text-title"><img alt="" src="<?=base_url()?>public/img/icon/eye.png" /> <span class="nav-title"><a href="<?=base_url()?>users" class="Lblue">สิทธิ์ผู้ใช้</a></span></div>
</div>

<!-- Journal -->
<div class="nav-title-<?=($this->router->class=='journal')? 'select': 'default';?>">
	<div class="nav-text-title"><img alt="" src="<?=base_url()?>public/img/icon/book.png" /> <span class="nav-title"><a href="<?=base_url()?>journal" class="Lblue">วารสาร</a></span></div>
	<div class="nav-icon"><img alt="" src="<?=base_url()?>public/img/icon/<?=($this->router->class=='journal')? 'resultset_up.png': 'resultset_down.png';?>" id="arrow2" class="nav-img-icon" onclick="changeStatus('2')" /></div>
</div>
<div id="nav-msg-body2" <?=($this->router->class=='journal')? '': 'class=\'hide\'';?>>
	<div class="nav-body<?=($this->router->class=='journal' && $this->router->method=='addnew')? '-select': '';?>"><a href="<?=base_url()?>journal/addnew" class="LblueS">+เพิ่มวารสาร</a></div>
	<div class="nav-body<?=($this->router->class=='journal' && $this->router->method=='index')? '-select': '';?>"><a href="<?=base_url()?>journal" class="LblueS">วารสารทั้งหมด</a></div>
</div>

<!-- Publication -->
<div class="nav-title-<?=($this->router->class=='publication')? 'select': 'default';?>">
	<div class="nav-text-title"><img alt="" src="<?=base_url()?>public/img/icon/book.png" /> <span class="nav-title"><a href="<?=base_url()?>publication" class="Lblue">ผลงานตีพิมพ์</a></span></div>
	<div class="nav-icon"><img alt="" src="<?=base_url()?>public/img/icon/<?=($this->router->class=='publication')? 'resultset_up.png': 'resultset_down.png';?>" id="arrow3" class="nav-img-icon" onclick="changeStatus('3')" /></div>
</div>
<div id="nav-msg-body3" <?=($this->router->class=='publication')? '': 'class=\'hide\'';?>>
	<div class="nav-body<?=($this->router->class=='publication' && $this->router->method=='addnew')? '-select': '';?>"><a href="<?=base_url()?>publication/addnew" class="LblueS">+เพิ่มผลงานตีพิมพ์</a></div>
	<div class="nav-body<?=($this->router->class=='publication' && $this->router->method=='index')? '-select': '';?>"><a href="<?=base_url()?>publication" class="LblueS">ผลงานตีพิมพ์ทั้งหมด</a></div>
</div>

<!-- Travel By -->
<div class="nav-title-<?=($this->router->class=='report')? 'select': 'default';?>">
	<div class="nav-text-title"><img alt="" src="<?=base_url()?>public/img/icon/application_cascade.png" /> <span class="nav-title"><a href="<?=base_url()?>report/one" class="Lblue">รายงาน</a></span></div>
	<div class="nav-icon"><img alt="" src="<?=base_url()?>public/img/icon/<?=($this->router->class=='travel_by')? 'resultset_up.png': 'resultset_down.png';?>" id="arrow4" class="nav-img-icon" onclick="changeStatus('4')" /></div>
</div>
<div id="nav-msg-body4" <?=($this->router->class=='report')? '': 'class=\'hide\'';?>>
	<div class="nav-body<?=($this->router->class=='report' && $this->router->method=='one')? '-select': '';?>"><a href="<?=base_url()?>report/one" class="LblueS">ข้อมูลนักวิจัย</a></div>
        <div class="nav-body<?=($this->router->class=='report' && $this->router->method=='two')? '-select': '';?>"><a href="<?=base_url()?>report/two" class="LblueS">ข้อมูลการตีพิมพ์</a></div>
</div>