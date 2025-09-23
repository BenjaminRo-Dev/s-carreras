FROM sail-8.4/app

USER root

# Crear directorio para configuraciones personalizadas de supervisor
RUN mkdir -p /etc/supervisor/conf.d/custom

# Copiar tu configuración de supervisor personalizada
COPY docker/supervisor/custom.conf /etc/supervisor/conf.d/custom/custom.conf

# Asegurarse de que las configuraciones se carguen
RUN chown -R sail:sail /etc/supervisor/conf.d/custom/

# Reiniciar supervisor para cargar nuevas configuraciones (se hará en start-container)
USER sail