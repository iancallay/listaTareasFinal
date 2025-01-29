import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { EditartareaPageRoutingModule } from './editartarea-routing.module';

import { EditartareaPage } from './editartarea.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    EditartareaPageRoutingModule
  ],
  declarations: [EditartareaPage]
})
export class EditartareaPageModule {}
