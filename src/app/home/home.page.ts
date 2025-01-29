import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { NavController } from '@ionic/angular';

@Component({
  selector: 'app-home',
  templateUrl: 'home.page.html',
  styleUrls: ['home.page.scss'],
  standalone: false,
})
export class HomePage {

  constructor(
    private navCtrl: NavController,
    private rouCtrl: Router
  ) { }

  crear() {
    this.navCtrl.navigateForward('/creartarea');
  }

  detalle() {
    this.rouCtrl.navigate(['/detalles']);
  }

}
