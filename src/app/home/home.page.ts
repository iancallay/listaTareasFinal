import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { ModalController, NavController } from '@ionic/angular';

@Component({
  selector: 'app-home',
  templateUrl: 'home.page.html',
  styleUrls: ['home.page.scss'],
  standalone: false,
})
export class HomePage {


  isModalOpen = false
  titulo: string = ""
  descripcion: string = ""
  estado: string = ""
  formData: any = []

  constructor(
    private navCtrl: NavController,
    private rouCtrl: Router,
    private modalCtrl: ModalController
  ) { }

  crear() {
    this.navCtrl.navigateForward('/creartarea');
  }

  detalle() {
    this.rouCtrl.navigate(['/detalles']);
  }

  setOpen(isModalOpen: boolean) {
    this.isModalOpen = !this.isModalOpen
  }

  submitForm() {
    this.formData.push({
      titulo: this.titulo,
      descripcion: this.descripcion,
      estado: this.estado
    })
    this.setOpen(this.isModalOpen)
  }
}
